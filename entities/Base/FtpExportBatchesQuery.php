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
use entities\FtpExportBatches as ChildFtpExportBatches;
use entities\FtpExportBatchesQuery as ChildFtpExportBatchesQuery;
use entities\Map\FtpExportBatchesTableMap;

/**
 * Base class that represents a query for the `ftp_export_batches` table.
 *
 * @method     ChildFtpExportBatchesQuery orderByFtpExportBatchId($order = Criteria::ASC) Order by the ftp_export_batch_id column
 * @method     ChildFtpExportBatchesQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildFtpExportBatchesQuery orderByAttachedFunction($order = Criteria::ASC) Order by the attached_function column
 * @method     ChildFtpExportBatchesQuery orderByNextDate($order = Criteria::ASC) Order by the next_date column
 * @method     ChildFtpExportBatchesQuery orderByIntervalDays($order = Criteria::ASC) Order by the interval_days column
 * @method     ChildFtpExportBatchesQuery orderByFtpPath($order = Criteria::ASC) Order by the ftp_path column
 * @method     ChildFtpExportBatchesQuery orderByIsenabled($order = Criteria::ASC) Order by the isenabled column
 * @method     ChildFtpExportBatchesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildFtpExportBatchesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFtpExportBatchesQuery orderByFileNameFormat($order = Criteria::ASC) Order by the file_name_format column
 * @method     ChildFtpExportBatchesQuery orderByIsFileProcessing($order = Criteria::ASC) Order by the is_file_processing column
 * @method     ChildFtpExportBatchesQuery orderByFtpOrder($order = Criteria::ASC) Order by the ftp_order column
 * @method     ChildFtpExportBatchesQuery orderByIntervalType($order = Criteria::ASC) Order by the interval_type column
 * @method     ChildFtpExportBatchesQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildFtpExportBatchesQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildFtpExportBatchesQuery groupByFtpExportBatchId() Group by the ftp_export_batch_id column
 * @method     ChildFtpExportBatchesQuery groupByLabel() Group by the label column
 * @method     ChildFtpExportBatchesQuery groupByAttachedFunction() Group by the attached_function column
 * @method     ChildFtpExportBatchesQuery groupByNextDate() Group by the next_date column
 * @method     ChildFtpExportBatchesQuery groupByIntervalDays() Group by the interval_days column
 * @method     ChildFtpExportBatchesQuery groupByFtpPath() Group by the ftp_path column
 * @method     ChildFtpExportBatchesQuery groupByIsenabled() Group by the isenabled column
 * @method     ChildFtpExportBatchesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildFtpExportBatchesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFtpExportBatchesQuery groupByFileNameFormat() Group by the file_name_format column
 * @method     ChildFtpExportBatchesQuery groupByIsFileProcessing() Group by the is_file_processing column
 * @method     ChildFtpExportBatchesQuery groupByFtpOrder() Group by the ftp_order column
 * @method     ChildFtpExportBatchesQuery groupByIntervalType() Group by the interval_type column
 * @method     ChildFtpExportBatchesQuery groupByStartDate() Group by the start_date column
 * @method     ChildFtpExportBatchesQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildFtpExportBatchesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFtpExportBatchesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFtpExportBatchesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFtpExportBatchesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFtpExportBatchesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFtpExportBatchesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFtpExportBatchesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildFtpExportBatchesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildFtpExportBatchesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildFtpExportBatchesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildFtpExportBatchesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpExportBatchesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpExportBatchesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildFtpExportBatchesQuery leftJoinFtpExportLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpExportLogs relation
 * @method     ChildFtpExportBatchesQuery rightJoinFtpExportLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpExportLogs relation
 * @method     ChildFtpExportBatchesQuery innerJoinFtpExportLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpExportLogs relation
 *
 * @method     ChildFtpExportBatchesQuery joinWithFtpExportLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpExportLogs relation
 *
 * @method     ChildFtpExportBatchesQuery leftJoinWithFtpExportLogs() Adds a LEFT JOIN clause and with to the query using the FtpExportLogs relation
 * @method     ChildFtpExportBatchesQuery rightJoinWithFtpExportLogs() Adds a RIGHT JOIN clause and with to the query using the FtpExportLogs relation
 * @method     ChildFtpExportBatchesQuery innerJoinWithFtpExportLogs() Adds a INNER JOIN clause and with to the query using the FtpExportLogs relation
 *
 * @method     \entities\CompanyQuery|\entities\FtpExportLogsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFtpExportBatches|null findOne(?ConnectionInterface $con = null) Return the first ChildFtpExportBatches matching the query
 * @method     ChildFtpExportBatches findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFtpExportBatches matching the query, or a new ChildFtpExportBatches object populated from the query conditions when no match is found
 *
 * @method     ChildFtpExportBatches|null findOneByFtpExportBatchId(int $ftp_export_batch_id) Return the first ChildFtpExportBatches filtered by the ftp_export_batch_id column
 * @method     ChildFtpExportBatches|null findOneByLabel(string $label) Return the first ChildFtpExportBatches filtered by the label column
 * @method     ChildFtpExportBatches|null findOneByAttachedFunction(string $attached_function) Return the first ChildFtpExportBatches filtered by the attached_function column
 * @method     ChildFtpExportBatches|null findOneByNextDate(string $next_date) Return the first ChildFtpExportBatches filtered by the next_date column
 * @method     ChildFtpExportBatches|null findOneByIntervalDays(int $interval_days) Return the first ChildFtpExportBatches filtered by the interval_days column
 * @method     ChildFtpExportBatches|null findOneByFtpPath(string $ftp_path) Return the first ChildFtpExportBatches filtered by the ftp_path column
 * @method     ChildFtpExportBatches|null findOneByIsenabled(int $isenabled) Return the first ChildFtpExportBatches filtered by the isenabled column
 * @method     ChildFtpExportBatches|null findOneByCompanyId(int $company_id) Return the first ChildFtpExportBatches filtered by the company_id column
 * @method     ChildFtpExportBatches|null findOneByCreatedAt(string $created_at) Return the first ChildFtpExportBatches filtered by the created_at column
 * @method     ChildFtpExportBatches|null findOneByFileNameFormat(string $file_name_format) Return the first ChildFtpExportBatches filtered by the file_name_format column
 * @method     ChildFtpExportBatches|null findOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpExportBatches filtered by the is_file_processing column
 * @method     ChildFtpExportBatches|null findOneByFtpOrder(int $ftp_order) Return the first ChildFtpExportBatches filtered by the ftp_order column
 * @method     ChildFtpExportBatches|null findOneByIntervalType(string $interval_type) Return the first ChildFtpExportBatches filtered by the interval_type column
 * @method     ChildFtpExportBatches|null findOneByStartDate(string $start_date) Return the first ChildFtpExportBatches filtered by the start_date column
 * @method     ChildFtpExportBatches|null findOneByEndDate(string $end_date) Return the first ChildFtpExportBatches filtered by the end_date column
 *
 * @method     ChildFtpExportBatches requirePk($key, ?ConnectionInterface $con = null) Return the ChildFtpExportBatches by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOne(?ConnectionInterface $con = null) Return the first ChildFtpExportBatches matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpExportBatches requireOneByFtpExportBatchId(int $ftp_export_batch_id) Return the first ChildFtpExportBatches filtered by the ftp_export_batch_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByLabel(string $label) Return the first ChildFtpExportBatches filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByAttachedFunction(string $attached_function) Return the first ChildFtpExportBatches filtered by the attached_function column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByNextDate(string $next_date) Return the first ChildFtpExportBatches filtered by the next_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByIntervalDays(int $interval_days) Return the first ChildFtpExportBatches filtered by the interval_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByFtpPath(string $ftp_path) Return the first ChildFtpExportBatches filtered by the ftp_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByIsenabled(int $isenabled) Return the first ChildFtpExportBatches filtered by the isenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByCompanyId(int $company_id) Return the first ChildFtpExportBatches filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByCreatedAt(string $created_at) Return the first ChildFtpExportBatches filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByFileNameFormat(string $file_name_format) Return the first ChildFtpExportBatches filtered by the file_name_format column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpExportBatches filtered by the is_file_processing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByFtpOrder(int $ftp_order) Return the first ChildFtpExportBatches filtered by the ftp_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByIntervalType(string $interval_type) Return the first ChildFtpExportBatches filtered by the interval_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByStartDate(string $start_date) Return the first ChildFtpExportBatches filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportBatches requireOneByEndDate(string $end_date) Return the first ChildFtpExportBatches filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpExportBatches[]|Collection find(?ConnectionInterface $con = null) Return ChildFtpExportBatches objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> find(?ConnectionInterface $con = null) Return ChildFtpExportBatches objects based on current ModelCriteria
 *
 * @method     ChildFtpExportBatches[]|Collection findByFtpExportBatchId(int|array<int> $ftp_export_batch_id) Return ChildFtpExportBatches objects filtered by the ftp_export_batch_id column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByFtpExportBatchId(int|array<int> $ftp_export_batch_id) Return ChildFtpExportBatches objects filtered by the ftp_export_batch_id column
 * @method     ChildFtpExportBatches[]|Collection findByLabel(string|array<string> $label) Return ChildFtpExportBatches objects filtered by the label column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByLabel(string|array<string> $label) Return ChildFtpExportBatches objects filtered by the label column
 * @method     ChildFtpExportBatches[]|Collection findByAttachedFunction(string|array<string> $attached_function) Return ChildFtpExportBatches objects filtered by the attached_function column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByAttachedFunction(string|array<string> $attached_function) Return ChildFtpExportBatches objects filtered by the attached_function column
 * @method     ChildFtpExportBatches[]|Collection findByNextDate(string|array<string> $next_date) Return ChildFtpExportBatches objects filtered by the next_date column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByNextDate(string|array<string> $next_date) Return ChildFtpExportBatches objects filtered by the next_date column
 * @method     ChildFtpExportBatches[]|Collection findByIntervalDays(int|array<int> $interval_days) Return ChildFtpExportBatches objects filtered by the interval_days column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByIntervalDays(int|array<int> $interval_days) Return ChildFtpExportBatches objects filtered by the interval_days column
 * @method     ChildFtpExportBatches[]|Collection findByFtpPath(string|array<string> $ftp_path) Return ChildFtpExportBatches objects filtered by the ftp_path column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByFtpPath(string|array<string> $ftp_path) Return ChildFtpExportBatches objects filtered by the ftp_path column
 * @method     ChildFtpExportBatches[]|Collection findByIsenabled(int|array<int> $isenabled) Return ChildFtpExportBatches objects filtered by the isenabled column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByIsenabled(int|array<int> $isenabled) Return ChildFtpExportBatches objects filtered by the isenabled column
 * @method     ChildFtpExportBatches[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildFtpExportBatches objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByCompanyId(int|array<int> $company_id) Return ChildFtpExportBatches objects filtered by the company_id column
 * @method     ChildFtpExportBatches[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildFtpExportBatches objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByCreatedAt(string|array<string> $created_at) Return ChildFtpExportBatches objects filtered by the created_at column
 * @method     ChildFtpExportBatches[]|Collection findByFileNameFormat(string|array<string> $file_name_format) Return ChildFtpExportBatches objects filtered by the file_name_format column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByFileNameFormat(string|array<string> $file_name_format) Return ChildFtpExportBatches objects filtered by the file_name_format column
 * @method     ChildFtpExportBatches[]|Collection findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpExportBatches objects filtered by the is_file_processing column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpExportBatches objects filtered by the is_file_processing column
 * @method     ChildFtpExportBatches[]|Collection findByFtpOrder(int|array<int> $ftp_order) Return ChildFtpExportBatches objects filtered by the ftp_order column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByFtpOrder(int|array<int> $ftp_order) Return ChildFtpExportBatches objects filtered by the ftp_order column
 * @method     ChildFtpExportBatches[]|Collection findByIntervalType(string|array<string> $interval_type) Return ChildFtpExportBatches objects filtered by the interval_type column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByIntervalType(string|array<string> $interval_type) Return ChildFtpExportBatches objects filtered by the interval_type column
 * @method     ChildFtpExportBatches[]|Collection findByStartDate(string|array<string> $start_date) Return ChildFtpExportBatches objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByStartDate(string|array<string> $start_date) Return ChildFtpExportBatches objects filtered by the start_date column
 * @method     ChildFtpExportBatches[]|Collection findByEndDate(string|array<string> $end_date) Return ChildFtpExportBatches objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildFtpExportBatches> findByEndDate(string|array<string> $end_date) Return ChildFtpExportBatches objects filtered by the end_date column
 *
 * @method     ChildFtpExportBatches[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFtpExportBatches> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class FtpExportBatchesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\FtpExportBatchesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\FtpExportBatches', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFtpExportBatchesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFtpExportBatchesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFtpExportBatchesQuery) {
            return $criteria;
        }
        $query = new ChildFtpExportBatchesQuery();
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
     * @return ChildFtpExportBatches|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FtpExportBatchesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFtpExportBatches A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ftp_export_batch_id, label, attached_function, next_date, interval_days, ftp_path, isenabled, company_id, created_at, file_name_format, is_file_processing, ftp_order, interval_type, start_date, end_date FROM ftp_export_batches WHERE ftp_export_batch_id = :p0';
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
            /** @var ChildFtpExportBatches $obj */
            $obj = new ChildFtpExportBatches();
            $obj->hydrate($row);
            FtpExportBatchesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFtpExportBatches|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ftp_export_batch_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpExportBatchId(1234); // WHERE ftp_export_batch_id = 1234
     * $query->filterByFtpExportBatchId(array(12, 34)); // WHERE ftp_export_batch_id IN (12, 34)
     * $query->filterByFtpExportBatchId(array('min' => 12)); // WHERE ftp_export_batch_id > 12
     * </code>
     *
     * @param mixed $ftpExportBatchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportBatchId($ftpExportBatchId = null, ?string $comparison = null)
    {
        if (is_array($ftpExportBatchId)) {
            $useMinMax = false;
            if (isset($ftpExportBatchId['min'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpExportBatchId['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId, $comparison);

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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_LABEL, $label, $comparison);

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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION, $attachedFunction, $comparison);

        return $this;
    }

    /**
     * Filter the query on the next_date column
     *
     * Example usage:
     * <code>
     * $query->filterByNextDate('2011-03-14'); // WHERE next_date = '2011-03-14'
     * $query->filterByNextDate('now'); // WHERE next_date = '2011-03-14'
     * $query->filterByNextDate(array('max' => 'yesterday')); // WHERE next_date > '2011-03-13'
     * </code>
     *
     * @param mixed $nextDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNextDate($nextDate = null, ?string $comparison = null)
    {
        if (is_array($nextDate)) {
            $useMinMax = false;
            if (isset($nextDate['min'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_NEXT_DATE, $nextDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nextDate['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_NEXT_DATE, $nextDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_NEXT_DATE, $nextDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the interval_days column
     *
     * Example usage:
     * <code>
     * $query->filterByIntervalDays(1234); // WHERE interval_days = 1234
     * $query->filterByIntervalDays(array(12, 34)); // WHERE interval_days IN (12, 34)
     * $query->filterByIntervalDays(array('min' => 12)); // WHERE interval_days > 12
     * </code>
     *
     * @param mixed $intervalDays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntervalDays($intervalDays = null, ?string $comparison = null)
    {
        if (is_array($intervalDays)) {
            $useMinMax = false;
            if (isset($intervalDays['min'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_INTERVAL_DAYS, $intervalDays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($intervalDays['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_INTERVAL_DAYS, $intervalDays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_INTERVAL_DAYS, $intervalDays, $comparison);

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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_PATH, $ftpPath, $comparison);

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
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_ISENABLED, $isenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isenabled['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_ISENABLED, $isenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_ISENABLED, $isenabled, $comparison);

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
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_name_format column
     *
     * Example usage:
     * <code>
     * $query->filterByFileNameFormat('fooValue');   // WHERE file_name_format = 'fooValue'
     * $query->filterByFileNameFormat('%fooValue%', Criteria::LIKE); // WHERE file_name_format LIKE '%fooValue%'
     * $query->filterByFileNameFormat(['foo', 'bar']); // WHERE file_name_format IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fileNameFormat The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileNameFormat($fileNameFormat = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileNameFormat)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT, $fileNameFormat, $comparison);

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

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING, $isFileProcessing, $comparison);

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
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_ORDER, $ftpOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpOrder['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_ORDER, $ftpOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_ORDER, $ftpOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the interval_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIntervalType('fooValue');   // WHERE interval_type = 'fooValue'
     * $query->filterByIntervalType('%fooValue%', Criteria::LIKE); // WHERE interval_type LIKE '%fooValue%'
     * $query->filterByIntervalType(['foo', 'bar']); // WHERE interval_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $intervalType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntervalType($intervalType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($intervalType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_INTERVAL_TYPE, $intervalType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, ?string $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, ?string $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(FtpExportBatchesTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportBatchesTableMap::COL_END_DATE, $endDate, $comparison);

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
                ->addUsingAlias(FtpExportBatchesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpExportBatchesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\FtpExportLogs object
     *
     * @param \entities\FtpExportLogs|ObjectCollection $ftpExportLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportLogs($ftpExportLogs, ?string $comparison = null)
    {
        if ($ftpExportLogs instanceof \entities\FtpExportLogs) {
            $this
                ->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportLogs->getFtpExportBatchId(), $comparison);

            return $this;
        } elseif ($ftpExportLogs instanceof ObjectCollection) {
            $this
                ->useFtpExportLogsQuery()
                ->filterByPrimaryKeys($ftpExportLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpExportLogs() only accepts arguments of type \entities\FtpExportLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpExportLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpExportLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpExportLogs');

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
            $this->addJoinObject($join, 'FtpExportLogs');
        }

        return $this;
    }

    /**
     * Use the FtpExportLogs relation FtpExportLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpExportLogsQuery A secondary query class using the current class as primary query
     */
    public function useFtpExportLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpExportLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpExportLogs', '\entities\FtpExportLogsQuery');
    }

    /**
     * Use the FtpExportLogs relation FtpExportLogs object
     *
     * @param callable(\entities\FtpExportLogsQuery):\entities\FtpExportLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpExportLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpExportLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpExportLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the EXISTS statement
     */
    public function useFtpExportLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useExistsQuery('FtpExportLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for a NOT EXISTS query.
     *
     * @see useFtpExportLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpExportLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useExistsQuery('FtpExportLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the IN statement
     */
    public function useInFtpExportLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useInQuery('FtpExportLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for a NOT IN query.
     *
     * @see useFtpExportLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpExportLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useInQuery('FtpExportLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildFtpExportBatches $ftpExportBatches Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ftpExportBatches = null)
    {
        if ($ftpExportBatches) {
            $this->addUsingAlias(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatches->getFtpExportBatchId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ftp_export_batches table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FtpExportBatchesTableMap::clearInstancePool();
            FtpExportBatchesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FtpExportBatchesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FtpExportBatchesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FtpExportBatchesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
