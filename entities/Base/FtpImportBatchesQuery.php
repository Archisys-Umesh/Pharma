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
use entities\FtpImportBatches as ChildFtpImportBatches;
use entities\FtpImportBatchesQuery as ChildFtpImportBatchesQuery;
use entities\Map\FtpImportBatchesTableMap;

/**
 * Base class that represents a query for the `ftp_import_batches` table.
 *
 * @method     ChildFtpImportBatchesQuery orderByFtpImportBatchId($order = Criteria::ASC) Order by the ftp_import_batch_id column
 * @method     ChildFtpImportBatchesQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildFtpImportBatchesQuery orderByAttachedFunction($order = Criteria::ASC) Order by the attached_function column
 * @method     ChildFtpImportBatchesQuery orderByNextBatch($order = Criteria::ASC) Order by the next_batch column
 * @method     ChildFtpImportBatchesQuery orderByFtpPath($order = Criteria::ASC) Order by the ftp_path column
 * @method     ChildFtpImportBatchesQuery orderByIsenabled($order = Criteria::ASC) Order by the isenabled column
 * @method     ChildFtpImportBatchesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFtpImportBatchesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildFtpImportBatchesQuery orderByFtpOrder($order = Criteria::ASC) Order by the ftp_order column
 * @method     ChildFtpImportBatchesQuery orderByIsFileProcessing($order = Criteria::ASC) Order by the is_file_processing column
 *
 * @method     ChildFtpImportBatchesQuery groupByFtpImportBatchId() Group by the ftp_import_batch_id column
 * @method     ChildFtpImportBatchesQuery groupByLabel() Group by the label column
 * @method     ChildFtpImportBatchesQuery groupByAttachedFunction() Group by the attached_function column
 * @method     ChildFtpImportBatchesQuery groupByNextBatch() Group by the next_batch column
 * @method     ChildFtpImportBatchesQuery groupByFtpPath() Group by the ftp_path column
 * @method     ChildFtpImportBatchesQuery groupByIsenabled() Group by the isenabled column
 * @method     ChildFtpImportBatchesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFtpImportBatchesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildFtpImportBatchesQuery groupByFtpOrder() Group by the ftp_order column
 * @method     ChildFtpImportBatchesQuery groupByIsFileProcessing() Group by the is_file_processing column
 *
 * @method     ChildFtpImportBatchesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFtpImportBatchesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFtpImportBatchesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFtpImportBatchesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFtpImportBatchesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFtpImportBatchesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFtpImportBatchesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildFtpImportBatchesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildFtpImportBatchesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildFtpImportBatchesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildFtpImportBatchesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpImportBatchesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpImportBatchesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildFtpImportBatchesQuery leftJoinFtpImportLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpImportLogs relation
 * @method     ChildFtpImportBatchesQuery rightJoinFtpImportLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpImportLogs relation
 * @method     ChildFtpImportBatchesQuery innerJoinFtpImportLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpImportLogs relation
 *
 * @method     ChildFtpImportBatchesQuery joinWithFtpImportLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpImportLogs relation
 *
 * @method     ChildFtpImportBatchesQuery leftJoinWithFtpImportLogs() Adds a LEFT JOIN clause and with to the query using the FtpImportLogs relation
 * @method     ChildFtpImportBatchesQuery rightJoinWithFtpImportLogs() Adds a RIGHT JOIN clause and with to the query using the FtpImportLogs relation
 * @method     ChildFtpImportBatchesQuery innerJoinWithFtpImportLogs() Adds a INNER JOIN clause and with to the query using the FtpImportLogs relation
 *
 * @method     \entities\CompanyQuery|\entities\FtpImportLogsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFtpImportBatches|null findOne(?ConnectionInterface $con = null) Return the first ChildFtpImportBatches matching the query
 * @method     ChildFtpImportBatches findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFtpImportBatches matching the query, or a new ChildFtpImportBatches object populated from the query conditions when no match is found
 *
 * @method     ChildFtpImportBatches|null findOneByFtpImportBatchId(int $ftp_import_batch_id) Return the first ChildFtpImportBatches filtered by the ftp_import_batch_id column
 * @method     ChildFtpImportBatches|null findOneByLabel(string $label) Return the first ChildFtpImportBatches filtered by the label column
 * @method     ChildFtpImportBatches|null findOneByAttachedFunction(string $attached_function) Return the first ChildFtpImportBatches filtered by the attached_function column
 * @method     ChildFtpImportBatches|null findOneByNextBatch(int $next_batch) Return the first ChildFtpImportBatches filtered by the next_batch column
 * @method     ChildFtpImportBatches|null findOneByFtpPath(string $ftp_path) Return the first ChildFtpImportBatches filtered by the ftp_path column
 * @method     ChildFtpImportBatches|null findOneByIsenabled(int $isenabled) Return the first ChildFtpImportBatches filtered by the isenabled column
 * @method     ChildFtpImportBatches|null findOneByCreatedAt(string $created_at) Return the first ChildFtpImportBatches filtered by the created_at column
 * @method     ChildFtpImportBatches|null findOneByCompanyId(int $company_id) Return the first ChildFtpImportBatches filtered by the company_id column
 * @method     ChildFtpImportBatches|null findOneByFtpOrder(int $ftp_order) Return the first ChildFtpImportBatches filtered by the ftp_order column
 * @method     ChildFtpImportBatches|null findOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpImportBatches filtered by the is_file_processing column
 *
 * @method     ChildFtpImportBatches requirePk($key, ?ConnectionInterface $con = null) Return the ChildFtpImportBatches by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOne(?ConnectionInterface $con = null) Return the first ChildFtpImportBatches matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpImportBatches requireOneByFtpImportBatchId(int $ftp_import_batch_id) Return the first ChildFtpImportBatches filtered by the ftp_import_batch_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByLabel(string $label) Return the first ChildFtpImportBatches filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByAttachedFunction(string $attached_function) Return the first ChildFtpImportBatches filtered by the attached_function column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByNextBatch(int $next_batch) Return the first ChildFtpImportBatches filtered by the next_batch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByFtpPath(string $ftp_path) Return the first ChildFtpImportBatches filtered by the ftp_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByIsenabled(int $isenabled) Return the first ChildFtpImportBatches filtered by the isenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByCreatedAt(string $created_at) Return the first ChildFtpImportBatches filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByCompanyId(int $company_id) Return the first ChildFtpImportBatches filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByFtpOrder(int $ftp_order) Return the first ChildFtpImportBatches filtered by the ftp_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportBatches requireOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpImportBatches filtered by the is_file_processing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpImportBatches[]|Collection find(?ConnectionInterface $con = null) Return ChildFtpImportBatches objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> find(?ConnectionInterface $con = null) Return ChildFtpImportBatches objects based on current ModelCriteria
 *
 * @method     ChildFtpImportBatches[]|Collection findByFtpImportBatchId(int|array<int> $ftp_import_batch_id) Return ChildFtpImportBatches objects filtered by the ftp_import_batch_id column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByFtpImportBatchId(int|array<int> $ftp_import_batch_id) Return ChildFtpImportBatches objects filtered by the ftp_import_batch_id column
 * @method     ChildFtpImportBatches[]|Collection findByLabel(string|array<string> $label) Return ChildFtpImportBatches objects filtered by the label column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByLabel(string|array<string> $label) Return ChildFtpImportBatches objects filtered by the label column
 * @method     ChildFtpImportBatches[]|Collection findByAttachedFunction(string|array<string> $attached_function) Return ChildFtpImportBatches objects filtered by the attached_function column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByAttachedFunction(string|array<string> $attached_function) Return ChildFtpImportBatches objects filtered by the attached_function column
 * @method     ChildFtpImportBatches[]|Collection findByNextBatch(int|array<int> $next_batch) Return ChildFtpImportBatches objects filtered by the next_batch column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByNextBatch(int|array<int> $next_batch) Return ChildFtpImportBatches objects filtered by the next_batch column
 * @method     ChildFtpImportBatches[]|Collection findByFtpPath(string|array<string> $ftp_path) Return ChildFtpImportBatches objects filtered by the ftp_path column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByFtpPath(string|array<string> $ftp_path) Return ChildFtpImportBatches objects filtered by the ftp_path column
 * @method     ChildFtpImportBatches[]|Collection findByIsenabled(int|array<int> $isenabled) Return ChildFtpImportBatches objects filtered by the isenabled column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByIsenabled(int|array<int> $isenabled) Return ChildFtpImportBatches objects filtered by the isenabled column
 * @method     ChildFtpImportBatches[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildFtpImportBatches objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByCreatedAt(string|array<string> $created_at) Return ChildFtpImportBatches objects filtered by the created_at column
 * @method     ChildFtpImportBatches[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildFtpImportBatches objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByCompanyId(int|array<int> $company_id) Return ChildFtpImportBatches objects filtered by the company_id column
 * @method     ChildFtpImportBatches[]|Collection findByFtpOrder(int|array<int> $ftp_order) Return ChildFtpImportBatches objects filtered by the ftp_order column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByFtpOrder(int|array<int> $ftp_order) Return ChildFtpImportBatches objects filtered by the ftp_order column
 * @method     ChildFtpImportBatches[]|Collection findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpImportBatches objects filtered by the is_file_processing column
 * @psalm-method Collection&\Traversable<ChildFtpImportBatches> findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpImportBatches objects filtered by the is_file_processing column
 *
 * @method     ChildFtpImportBatches[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFtpImportBatches> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class FtpImportBatchesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\FtpImportBatchesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\FtpImportBatches', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFtpImportBatchesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFtpImportBatchesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFtpImportBatchesQuery) {
            return $criteria;
        }
        $query = new ChildFtpImportBatchesQuery();
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
     * @return ChildFtpImportBatches|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FtpImportBatchesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FtpImportBatchesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFtpImportBatches A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ftp_import_batch_id, label, attached_function, next_batch, ftp_path, isenabled, created_at, company_id, ftp_order, is_file_processing FROM ftp_import_batches WHERE ftp_import_batch_id = :p0';
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
            /** @var ChildFtpImportBatches $obj */
            $obj = new ChildFtpImportBatches();
            $obj->hydrate($row);
            FtpImportBatchesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFtpImportBatches|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ftp_import_batch_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpImportBatchId(1234); // WHERE ftp_import_batch_id = 1234
     * $query->filterByFtpImportBatchId(array(12, 34)); // WHERE ftp_import_batch_id IN (12, 34)
     * $query->filterByFtpImportBatchId(array('min' => 12)); // WHERE ftp_import_batch_id > 12
     * </code>
     *
     * @param mixed $ftpImportBatchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportBatchId($ftpImportBatchId = null, ?string $comparison = null)
    {
        if (is_array($ftpImportBatchId)) {
            $useMinMax = false;
            if (isset($ftpImportBatchId['min'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpImportBatchId['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%', Criteria::LIKE); // WHERE label LIKE '%fooValue%'
     * $query->filterByLabel(['foo', 'bar']); // WHERE label IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $label The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLabel($label = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_LABEL, $label, $comparison);

        return $this;
    }

    /**
     * Filter the query on the attached_function column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachedFunction('fooValue');   // WHERE attached_function = 'fooValue'
     * $query->filterByAttachedFunction('%fooValue%', Criteria::LIKE); // WHERE attached_function LIKE '%fooValue%'
     * $query->filterByAttachedFunction(['foo', 'bar']); // WHERE attached_function IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $attachedFunction The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttachedFunction($attachedFunction = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($attachedFunction)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION, $attachedFunction, $comparison);

        return $this;
    }

    /**
     * Filter the query on the next_batch column
     *
     * Example usage:
     * <code>
     * $query->filterByNextBatch(1234); // WHERE next_batch = 1234
     * $query->filterByNextBatch(array(12, 34)); // WHERE next_batch IN (12, 34)
     * $query->filterByNextBatch(array('min' => 12)); // WHERE next_batch > 12
     * </code>
     *
     * @param mixed $nextBatch The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNextBatch($nextBatch = null, ?string $comparison = null)
    {
        if (is_array($nextBatch)) {
            $useMinMax = false;
            if (isset($nextBatch['min'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_NEXT_BATCH, $nextBatch['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nextBatch['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_NEXT_BATCH, $nextBatch['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_NEXT_BATCH, $nextBatch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ftp_path column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpPath('fooValue');   // WHERE ftp_path = 'fooValue'
     * $query->filterByFtpPath('%fooValue%', Criteria::LIKE); // WHERE ftp_path LIKE '%fooValue%'
     * $query->filterByFtpPath(['foo', 'bar']); // WHERE ftp_path IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ftpPath The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpPath($ftpPath = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ftpPath)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_PATH, $ftpPath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isenabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsenabled(1234); // WHERE isenabled = 1234
     * $query->filterByIsenabled(array(12, 34)); // WHERE isenabled IN (12, 34)
     * $query->filterByIsenabled(array('min' => 12)); // WHERE isenabled > 12
     * </code>
     *
     * @param mixed $isenabled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsenabled($isenabled = null, ?string $comparison = null)
    {
        if (is_array($isenabled)) {
            $useMinMax = false;
            if (isset($isenabled['min'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_ISENABLED, $isenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isenabled['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_ISENABLED, $isenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_ISENABLED, $isenabled, $comparison);

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
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ftp_order column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpOrder(1234); // WHERE ftp_order = 1234
     * $query->filterByFtpOrder(array(12, 34)); // WHERE ftp_order IN (12, 34)
     * $query->filterByFtpOrder(array('min' => 12)); // WHERE ftp_order > 12
     * </code>
     *
     * @param mixed $ftpOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpOrder($ftpOrder = null, ?string $comparison = null)
    {
        if (is_array($ftpOrder)) {
            $useMinMax = false;
            if (isset($ftpOrder['min'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_ORDER, $ftpOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpOrder['max'])) {
                $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_ORDER, $ftpOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_ORDER, $ftpOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_file_processing column
     *
     * Example usage:
     * <code>
     * $query->filterByIsFileProcessing(true); // WHERE is_file_processing = true
     * $query->filterByIsFileProcessing('yes'); // WHERE is_file_processing = true
     * </code>
     *
     * @param bool|string $isFileProcessing The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsFileProcessing($isFileProcessing = null, ?string $comparison = null)
    {
        if (is_string($isFileProcessing)) {
            $isFileProcessing = in_array(strtolower($isFileProcessing), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING, $isFileProcessing, $comparison);

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
                ->addUsingAlias(FtpImportBatchesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpImportBatchesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\FtpImportLogs object
     *
     * @param \entities\FtpImportLogs|ObjectCollection $ftpImportLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportLogs($ftpImportLogs, ?string $comparison = null)
    {
        if ($ftpImportLogs instanceof \entities\FtpImportLogs) {
            $this
                ->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportLogs->getFtpImportBatchId(), $comparison);

            return $this;
        } elseif ($ftpImportLogs instanceof ObjectCollection) {
            $this
                ->useFtpImportLogsQuery()
                ->filterByPrimaryKeys($ftpImportLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpImportLogs() only accepts arguments of type \entities\FtpImportLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpImportLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpImportLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpImportLogs');

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
            $this->addJoinObject($join, 'FtpImportLogs');
        }

        return $this;
    }

    /**
     * Use the FtpImportLogs relation FtpImportLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpImportLogsQuery A secondary query class using the current class as primary query
     */
    public function useFtpImportLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpImportLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpImportLogs', '\entities\FtpImportLogsQuery');
    }

    /**
     * Use the FtpImportLogs relation FtpImportLogs object
     *
     * @param callable(\entities\FtpImportLogsQuery):\entities\FtpImportLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpImportLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpImportLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpImportLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the EXISTS statement
     */
    public function useFtpImportLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useExistsQuery('FtpImportLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for a NOT EXISTS query.
     *
     * @see useFtpImportLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpImportLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useExistsQuery('FtpImportLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the IN statement
     */
    public function useInFtpImportLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useInQuery('FtpImportLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for a NOT IN query.
     *
     * @see useFtpImportLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpImportLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useInQuery('FtpImportLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildFtpImportBatches $ftpImportBatches Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ftpImportBatches = null)
    {
        if ($ftpImportBatches) {
            $this->addUsingAlias(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatches->getFtpImportBatchId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ftp_import_batches table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportBatchesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FtpImportBatchesTableMap::clearInstancePool();
            FtpImportBatchesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportBatchesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FtpImportBatchesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FtpImportBatchesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FtpImportBatchesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
