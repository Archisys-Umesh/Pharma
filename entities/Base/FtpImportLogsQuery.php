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
use entities\FtpImportLogs as ChildFtpImportLogs;
use entities\FtpImportLogsQuery as ChildFtpImportLogsQuery;
use entities\Map\FtpImportLogsTableMap;

/**
 * Base class that represents a query for the `ftp_import_logs` table.
 *
 * @method     ChildFtpImportLogsQuery orderByFtpImportLogId($order = Criteria::ASC) Order by the ftp_import_log_id column
 * @method     ChildFtpImportLogsQuery orderByFtpImportBatchId($order = Criteria::ASC) Order by the ftp_import_batch_id column
 * @method     ChildFtpImportLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildFtpImportLogsQuery orderByFilePath($order = Criteria::ASC) Order by the file_path column
 * @method     ChildFtpImportLogsQuery orderByNoTotalRecords($order = Criteria::ASC) Order by the no_total_records column
 * @method     ChildFtpImportLogsQuery orderByNoSuccessfulRecords($order = Criteria::ASC) Order by the no_successful_records column
 * @method     ChildFtpImportLogsQuery orderByNoFailedRecords($order = Criteria::ASC) Order by the no_failed_records column
 * @method     ChildFtpImportLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFtpImportLogsQuery orderByIsFileProcessed($order = Criteria::ASC) Order by the is_file_processed column
 * @method     ChildFtpImportLogsQuery orderByErrorMessage($order = Criteria::ASC) Order by the error_message column
 * @method     ChildFtpImportLogsQuery orderByIsFileProcessing($order = Criteria::ASC) Order by the is_file_processing column
 * @method     ChildFtpImportLogsQuery orderByNoProcessedRecords($order = Criteria::ASC) Order by the no_processed_records column
 * @method     ChildFtpImportLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildFtpImportLogsQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildFtpImportLogsQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 *
 * @method     ChildFtpImportLogsQuery groupByFtpImportLogId() Group by the ftp_import_log_id column
 * @method     ChildFtpImportLogsQuery groupByFtpImportBatchId() Group by the ftp_import_batch_id column
 * @method     ChildFtpImportLogsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildFtpImportLogsQuery groupByFilePath() Group by the file_path column
 * @method     ChildFtpImportLogsQuery groupByNoTotalRecords() Group by the no_total_records column
 * @method     ChildFtpImportLogsQuery groupByNoSuccessfulRecords() Group by the no_successful_records column
 * @method     ChildFtpImportLogsQuery groupByNoFailedRecords() Group by the no_failed_records column
 * @method     ChildFtpImportLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFtpImportLogsQuery groupByIsFileProcessed() Group by the is_file_processed column
 * @method     ChildFtpImportLogsQuery groupByErrorMessage() Group by the error_message column
 * @method     ChildFtpImportLogsQuery groupByIsFileProcessing() Group by the is_file_processing column
 * @method     ChildFtpImportLogsQuery groupByNoProcessedRecords() Group by the no_processed_records column
 * @method     ChildFtpImportLogsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildFtpImportLogsQuery groupByStartTime() Group by the start_time column
 * @method     ChildFtpImportLogsQuery groupByEndTime() Group by the end_time column
 *
 * @method     ChildFtpImportLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFtpImportLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFtpImportLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFtpImportLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFtpImportLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFtpImportLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFtpImportLogsQuery leftJoinFtpImportBatches($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpImportBatches relation
 * @method     ChildFtpImportLogsQuery rightJoinFtpImportBatches($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpImportBatches relation
 * @method     ChildFtpImportLogsQuery innerJoinFtpImportBatches($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpImportBatches relation
 *
 * @method     ChildFtpImportLogsQuery joinWithFtpImportBatches($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpImportBatches relation
 *
 * @method     ChildFtpImportLogsQuery leftJoinWithFtpImportBatches() Adds a LEFT JOIN clause and with to the query using the FtpImportBatches relation
 * @method     ChildFtpImportLogsQuery rightJoinWithFtpImportBatches() Adds a RIGHT JOIN clause and with to the query using the FtpImportBatches relation
 * @method     ChildFtpImportLogsQuery innerJoinWithFtpImportBatches() Adds a INNER JOIN clause and with to the query using the FtpImportBatches relation
 *
 * @method     ChildFtpImportLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildFtpImportLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildFtpImportLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildFtpImportLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildFtpImportLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpImportLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpImportLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\FtpImportBatchesQuery|\entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFtpImportLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildFtpImportLogs matching the query
 * @method     ChildFtpImportLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFtpImportLogs matching the query, or a new ChildFtpImportLogs object populated from the query conditions when no match is found
 *
 * @method     ChildFtpImportLogs|null findOneByFtpImportLogId(string $ftp_import_log_id) Return the first ChildFtpImportLogs filtered by the ftp_import_log_id column
 * @method     ChildFtpImportLogs|null findOneByFtpImportBatchId(int $ftp_import_batch_id) Return the first ChildFtpImportLogs filtered by the ftp_import_batch_id column
 * @method     ChildFtpImportLogs|null findOneByCompanyId(int $company_id) Return the first ChildFtpImportLogs filtered by the company_id column
 * @method     ChildFtpImportLogs|null findOneByFilePath(string $file_path) Return the first ChildFtpImportLogs filtered by the file_path column
 * @method     ChildFtpImportLogs|null findOneByNoTotalRecords(int $no_total_records) Return the first ChildFtpImportLogs filtered by the no_total_records column
 * @method     ChildFtpImportLogs|null findOneByNoSuccessfulRecords(int $no_successful_records) Return the first ChildFtpImportLogs filtered by the no_successful_records column
 * @method     ChildFtpImportLogs|null findOneByNoFailedRecords(int $no_failed_records) Return the first ChildFtpImportLogs filtered by the no_failed_records column
 * @method     ChildFtpImportLogs|null findOneByCreatedAt(string $created_at) Return the first ChildFtpImportLogs filtered by the created_at column
 * @method     ChildFtpImportLogs|null findOneByIsFileProcessed(int $is_file_processed) Return the first ChildFtpImportLogs filtered by the is_file_processed column
 * @method     ChildFtpImportLogs|null findOneByErrorMessage(string $error_message) Return the first ChildFtpImportLogs filtered by the error_message column
 * @method     ChildFtpImportLogs|null findOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpImportLogs filtered by the is_file_processing column
 * @method     ChildFtpImportLogs|null findOneByNoProcessedRecords(int $no_processed_records) Return the first ChildFtpImportLogs filtered by the no_processed_records column
 * @method     ChildFtpImportLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildFtpImportLogs filtered by the updated_at column
 * @method     ChildFtpImportLogs|null findOneByStartTime(string $start_time) Return the first ChildFtpImportLogs filtered by the start_time column
 * @method     ChildFtpImportLogs|null findOneByEndTime(string $end_time) Return the first ChildFtpImportLogs filtered by the end_time column
 *
 * @method     ChildFtpImportLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildFtpImportLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOne(?ConnectionInterface $con = null) Return the first ChildFtpImportLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpImportLogs requireOneByFtpImportLogId(string $ftp_import_log_id) Return the first ChildFtpImportLogs filtered by the ftp_import_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByFtpImportBatchId(int $ftp_import_batch_id) Return the first ChildFtpImportLogs filtered by the ftp_import_batch_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByCompanyId(int $company_id) Return the first ChildFtpImportLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByFilePath(string $file_path) Return the first ChildFtpImportLogs filtered by the file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByNoTotalRecords(int $no_total_records) Return the first ChildFtpImportLogs filtered by the no_total_records column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByNoSuccessfulRecords(int $no_successful_records) Return the first ChildFtpImportLogs filtered by the no_successful_records column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByNoFailedRecords(int $no_failed_records) Return the first ChildFtpImportLogs filtered by the no_failed_records column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByCreatedAt(string $created_at) Return the first ChildFtpImportLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByIsFileProcessed(int $is_file_processed) Return the first ChildFtpImportLogs filtered by the is_file_processed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByErrorMessage(string $error_message) Return the first ChildFtpImportLogs filtered by the error_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpImportLogs filtered by the is_file_processing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByNoProcessedRecords(int $no_processed_records) Return the first ChildFtpImportLogs filtered by the no_processed_records column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildFtpImportLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByStartTime(string $start_time) Return the first ChildFtpImportLogs filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpImportLogs requireOneByEndTime(string $end_time) Return the first ChildFtpImportLogs filtered by the end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpImportLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildFtpImportLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> find(?ConnectionInterface $con = null) Return ChildFtpImportLogs objects based on current ModelCriteria
 *
 * @method     ChildFtpImportLogs[]|Collection findByFtpImportLogId(string|array<string> $ftp_import_log_id) Return ChildFtpImportLogs objects filtered by the ftp_import_log_id column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByFtpImportLogId(string|array<string> $ftp_import_log_id) Return ChildFtpImportLogs objects filtered by the ftp_import_log_id column
 * @method     ChildFtpImportLogs[]|Collection findByFtpImportBatchId(int|array<int> $ftp_import_batch_id) Return ChildFtpImportLogs objects filtered by the ftp_import_batch_id column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByFtpImportBatchId(int|array<int> $ftp_import_batch_id) Return ChildFtpImportLogs objects filtered by the ftp_import_batch_id column
 * @method     ChildFtpImportLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildFtpImportLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByCompanyId(int|array<int> $company_id) Return ChildFtpImportLogs objects filtered by the company_id column
 * @method     ChildFtpImportLogs[]|Collection findByFilePath(string|array<string> $file_path) Return ChildFtpImportLogs objects filtered by the file_path column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByFilePath(string|array<string> $file_path) Return ChildFtpImportLogs objects filtered by the file_path column
 * @method     ChildFtpImportLogs[]|Collection findByNoTotalRecords(int|array<int> $no_total_records) Return ChildFtpImportLogs objects filtered by the no_total_records column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByNoTotalRecords(int|array<int> $no_total_records) Return ChildFtpImportLogs objects filtered by the no_total_records column
 * @method     ChildFtpImportLogs[]|Collection findByNoSuccessfulRecords(int|array<int> $no_successful_records) Return ChildFtpImportLogs objects filtered by the no_successful_records column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByNoSuccessfulRecords(int|array<int> $no_successful_records) Return ChildFtpImportLogs objects filtered by the no_successful_records column
 * @method     ChildFtpImportLogs[]|Collection findByNoFailedRecords(int|array<int> $no_failed_records) Return ChildFtpImportLogs objects filtered by the no_failed_records column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByNoFailedRecords(int|array<int> $no_failed_records) Return ChildFtpImportLogs objects filtered by the no_failed_records column
 * @method     ChildFtpImportLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildFtpImportLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByCreatedAt(string|array<string> $created_at) Return ChildFtpImportLogs objects filtered by the created_at column
 * @method     ChildFtpImportLogs[]|Collection findByIsFileProcessed(int|array<int> $is_file_processed) Return ChildFtpImportLogs objects filtered by the is_file_processed column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByIsFileProcessed(int|array<int> $is_file_processed) Return ChildFtpImportLogs objects filtered by the is_file_processed column
 * @method     ChildFtpImportLogs[]|Collection findByErrorMessage(string|array<string> $error_message) Return ChildFtpImportLogs objects filtered by the error_message column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByErrorMessage(string|array<string> $error_message) Return ChildFtpImportLogs objects filtered by the error_message column
 * @method     ChildFtpImportLogs[]|Collection findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpImportLogs objects filtered by the is_file_processing column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpImportLogs objects filtered by the is_file_processing column
 * @method     ChildFtpImportLogs[]|Collection findByNoProcessedRecords(int|array<int> $no_processed_records) Return ChildFtpImportLogs objects filtered by the no_processed_records column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByNoProcessedRecords(int|array<int> $no_processed_records) Return ChildFtpImportLogs objects filtered by the no_processed_records column
 * @method     ChildFtpImportLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildFtpImportLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildFtpImportLogs objects filtered by the updated_at column
 * @method     ChildFtpImportLogs[]|Collection findByStartTime(string|array<string> $start_time) Return ChildFtpImportLogs objects filtered by the start_time column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByStartTime(string|array<string> $start_time) Return ChildFtpImportLogs objects filtered by the start_time column
 * @method     ChildFtpImportLogs[]|Collection findByEndTime(string|array<string> $end_time) Return ChildFtpImportLogs objects filtered by the end_time column
 * @psalm-method Collection&\Traversable<ChildFtpImportLogs> findByEndTime(string|array<string> $end_time) Return ChildFtpImportLogs objects filtered by the end_time column
 *
 * @method     ChildFtpImportLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFtpImportLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class FtpImportLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\FtpImportLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\FtpImportLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFtpImportLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFtpImportLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFtpImportLogsQuery) {
            return $criteria;
        }
        $query = new ChildFtpImportLogsQuery();
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
     * @return ChildFtpImportLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FtpImportLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFtpImportLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ftp_import_log_id, ftp_import_batch_id, company_id, file_path, no_total_records, no_successful_records, no_failed_records, created_at, is_file_processed, error_message, is_file_processing, no_processed_records, updated_at, start_time, end_time FROM ftp_import_logs WHERE ftp_import_log_id = :p0';
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
            /** @var ChildFtpImportLogs $obj */
            $obj = new ChildFtpImportLogs();
            $obj->hydrate($row);
            FtpImportLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFtpImportLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ftp_import_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpImportLogId(1234); // WHERE ftp_import_log_id = 1234
     * $query->filterByFtpImportLogId(array(12, 34)); // WHERE ftp_import_log_id IN (12, 34)
     * $query->filterByFtpImportLogId(array('min' => 12)); // WHERE ftp_import_log_id > 12
     * </code>
     *
     * @param mixed $ftpImportLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportLogId($ftpImportLogId = null, ?string $comparison = null)
    {
        if (is_array($ftpImportLogId)) {
            $useMinMax = false;
            if (isset($ftpImportLogId['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $ftpImportLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpImportLogId['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $ftpImportLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $ftpImportLogId, $comparison);

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
     * @see       filterByFtpImportBatches()
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
                $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpImportBatchId['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatchId, $comparison);

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
                $this->addUsingAlias(FtpImportLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_path column
     *
     * Example usage:
     * <code>
     * $query->filterByFilePath('fooValue');   // WHERE file_path = 'fooValue'
     * $query->filterByFilePath('%fooValue%', Criteria::LIKE); // WHERE file_path LIKE '%fooValue%'
     * $query->filterByFilePath(['foo', 'bar']); // WHERE file_path IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $filePath The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFilePath($filePath = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($filePath)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_FILE_PATH, $filePath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_total_records column
     *
     * Example usage:
     * <code>
     * $query->filterByNoTotalRecords(1234); // WHERE no_total_records = 1234
     * $query->filterByNoTotalRecords(array(12, 34)); // WHERE no_total_records IN (12, 34)
     * $query->filterByNoTotalRecords(array('min' => 12)); // WHERE no_total_records > 12
     * </code>
     *
     * @param mixed $noTotalRecords The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoTotalRecords($noTotalRecords = null, ?string $comparison = null)
    {
        if (is_array($noTotalRecords)) {
            $useMinMax = false;
            if (isset($noTotalRecords['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS, $noTotalRecords['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noTotalRecords['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS, $noTotalRecords['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS, $noTotalRecords, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_successful_records column
     *
     * Example usage:
     * <code>
     * $query->filterByNoSuccessfulRecords(1234); // WHERE no_successful_records = 1234
     * $query->filterByNoSuccessfulRecords(array(12, 34)); // WHERE no_successful_records IN (12, 34)
     * $query->filterByNoSuccessfulRecords(array('min' => 12)); // WHERE no_successful_records > 12
     * </code>
     *
     * @param mixed $noSuccessfulRecords The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoSuccessfulRecords($noSuccessfulRecords = null, ?string $comparison = null)
    {
        if (is_array($noSuccessfulRecords)) {
            $useMinMax = false;
            if (isset($noSuccessfulRecords['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS, $noSuccessfulRecords['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noSuccessfulRecords['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS, $noSuccessfulRecords['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS, $noSuccessfulRecords, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_failed_records column
     *
     * Example usage:
     * <code>
     * $query->filterByNoFailedRecords(1234); // WHERE no_failed_records = 1234
     * $query->filterByNoFailedRecords(array(12, 34)); // WHERE no_failed_records IN (12, 34)
     * $query->filterByNoFailedRecords(array('min' => 12)); // WHERE no_failed_records > 12
     * </code>
     *
     * @param mixed $noFailedRecords The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoFailedRecords($noFailedRecords = null, ?string $comparison = null)
    {
        if (is_array($noFailedRecords)) {
            $useMinMax = false;
            if (isset($noFailedRecords['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS, $noFailedRecords['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noFailedRecords['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS, $noFailedRecords['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS, $noFailedRecords, $comparison);

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
                $this->addUsingAlias(FtpImportLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_file_processed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsFileProcessed(1234); // WHERE is_file_processed = 1234
     * $query->filterByIsFileProcessed(array(12, 34)); // WHERE is_file_processed IN (12, 34)
     * $query->filterByIsFileProcessed(array('min' => 12)); // WHERE is_file_processed > 12
     * </code>
     *
     * @param mixed $isFileProcessed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsFileProcessed($isFileProcessed = null, ?string $comparison = null)
    {
        if (is_array($isFileProcessed)) {
            $useMinMax = false;
            if (isset($isFileProcessed['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isFileProcessed['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the error_message column
     *
     * Example usage:
     * <code>
     * $query->filterByErrorMessage('fooValue');   // WHERE error_message = 'fooValue'
     * $query->filterByErrorMessage('%fooValue%', Criteria::LIKE); // WHERE error_message LIKE '%fooValue%'
     * $query->filterByErrorMessage(['foo', 'bar']); // WHERE error_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $errorMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByErrorMessage($errorMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($errorMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_ERROR_MESSAGE, $errorMessage, $comparison);

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

        $this->addUsingAlias(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING, $isFileProcessing, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_processed_records column
     *
     * Example usage:
     * <code>
     * $query->filterByNoProcessedRecords(1234); // WHERE no_processed_records = 1234
     * $query->filterByNoProcessedRecords(array(12, 34)); // WHERE no_processed_records IN (12, 34)
     * $query->filterByNoProcessedRecords(array('min' => 12)); // WHERE no_processed_records > 12
     * </code>
     *
     * @param mixed $noProcessedRecords The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoProcessedRecords($noProcessedRecords = null, ?string $comparison = null)
    {
        if (is_array($noProcessedRecords)) {
            $useMinMax = false;
            if (isset($noProcessedRecords['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noProcessedRecords['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords, $comparison);

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
                $this->addUsingAlias(FtpImportLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
     * </code>
     *
     * @param mixed $startTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartTime($startTime = null, ?string $comparison = null)
    {
        if (is_array($startTime)) {
            $useMinMax = false;
            if (isset($startTime['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_START_TIME, $startTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEndTime('2011-03-14'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime('now'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime(array('max' => 'yesterday')); // WHERE end_time > '2011-03-13'
     * </code>
     *
     * @param mixed $endTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndTime($endTime = null, ?string $comparison = null)
    {
        if (is_array($endTime)) {
            $useMinMax = false;
            if (isset($endTime['min'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endTime['max'])) {
                $this->addUsingAlias(FtpImportLogsTableMap::COL_END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpImportLogsTableMap::COL_END_TIME, $endTime, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\FtpImportBatches object
     *
     * @param \entities\FtpImportBatches|ObjectCollection $ftpImportBatches The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportBatches($ftpImportBatches, ?string $comparison = null)
    {
        if ($ftpImportBatches instanceof \entities\FtpImportBatches) {
            return $this
                ->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatches->getFtpImportBatchId(), $comparison);
        } elseif ($ftpImportBatches instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $ftpImportBatches->toKeyValue('PrimaryKey', 'FtpImportBatchId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByFtpImportBatches() only accepts arguments of type \entities\FtpImportBatches or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpImportBatches relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpImportBatches(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpImportBatches');

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
            $this->addJoinObject($join, 'FtpImportBatches');
        }

        return $this;
    }

    /**
     * Use the FtpImportBatches relation FtpImportBatches object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpImportBatchesQuery A secondary query class using the current class as primary query
     */
    public function useFtpImportBatchesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpImportBatches($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpImportBatches', '\entities\FtpImportBatchesQuery');
    }

    /**
     * Use the FtpImportBatches relation FtpImportBatches object
     *
     * @param callable(\entities\FtpImportBatchesQuery):\entities\FtpImportBatchesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpImportBatchesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpImportBatchesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpImportBatches table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the EXISTS statement
     */
    public function useFtpImportBatchesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useExistsQuery('FtpImportBatches', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for a NOT EXISTS query.
     *
     * @see useFtpImportBatchesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpImportBatchesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useExistsQuery('FtpImportBatches', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the IN statement
     */
    public function useInFtpImportBatchesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useInQuery('FtpImportBatches', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for a NOT IN query.
     *
     * @see useFtpImportBatchesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpImportBatchesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useInQuery('FtpImportBatches', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(FtpImportLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpImportLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildFtpImportLogs $ftpImportLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ftpImportLogs = null)
    {
        if ($ftpImportLogs) {
            $this->addUsingAlias(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $ftpImportLogs->getFtpImportLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ftp_import_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FtpImportLogsTableMap::clearInstancePool();
            FtpImportLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FtpImportLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FtpImportLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FtpImportLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
