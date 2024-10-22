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
use entities\FtpExportLogs as ChildFtpExportLogs;
use entities\FtpExportLogsQuery as ChildFtpExportLogsQuery;
use entities\Map\FtpExportLogsTableMap;

/**
 * Base class that represents a query for the `ftp_export_logs` table.
 *
 * @method     ChildFtpExportLogsQuery orderByFtpExportLogId($order = Criteria::ASC) Order by the ftp_export_log_id column
 * @method     ChildFtpExportLogsQuery orderByFtpExportBatchId($order = Criteria::ASC) Order by the ftp_export_batch_id column
 * @method     ChildFtpExportLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildFtpExportLogsQuery orderByFilePath($order = Criteria::ASC) Order by the file_path column
 * @method     ChildFtpExportLogsQuery orderByHasError($order = Criteria::ASC) Order by the has_error column
 * @method     ChildFtpExportLogsQuery orderByErrorMessage($order = Criteria::ASC) Order by the error_message column
 * @method     ChildFtpExportLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFtpExportLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildFtpExportLogsQuery orderByExportStartDate($order = Criteria::ASC) Order by the export_start_date column
 * @method     ChildFtpExportLogsQuery orderByExportEndDate($order = Criteria::ASC) Order by the export_end_date column
 * @method     ChildFtpExportLogsQuery orderByIsFileProcessed($order = Criteria::ASC) Order by the is_file_processed column
 * @method     ChildFtpExportLogsQuery orderByIsFileProcessing($order = Criteria::ASC) Order by the is_file_processing column
 * @method     ChildFtpExportLogsQuery orderByNoProcessedRecords($order = Criteria::ASC) Order by the no_processed_records column
 * @method     ChildFtpExportLogsQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildFtpExportLogsQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 *
 * @method     ChildFtpExportLogsQuery groupByFtpExportLogId() Group by the ftp_export_log_id column
 * @method     ChildFtpExportLogsQuery groupByFtpExportBatchId() Group by the ftp_export_batch_id column
 * @method     ChildFtpExportLogsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildFtpExportLogsQuery groupByFilePath() Group by the file_path column
 * @method     ChildFtpExportLogsQuery groupByHasError() Group by the has_error column
 * @method     ChildFtpExportLogsQuery groupByErrorMessage() Group by the error_message column
 * @method     ChildFtpExportLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFtpExportLogsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildFtpExportLogsQuery groupByExportStartDate() Group by the export_start_date column
 * @method     ChildFtpExportLogsQuery groupByExportEndDate() Group by the export_end_date column
 * @method     ChildFtpExportLogsQuery groupByIsFileProcessed() Group by the is_file_processed column
 * @method     ChildFtpExportLogsQuery groupByIsFileProcessing() Group by the is_file_processing column
 * @method     ChildFtpExportLogsQuery groupByNoProcessedRecords() Group by the no_processed_records column
 * @method     ChildFtpExportLogsQuery groupByStartTime() Group by the start_time column
 * @method     ChildFtpExportLogsQuery groupByEndTime() Group by the end_time column
 *
 * @method     ChildFtpExportLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFtpExportLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFtpExportLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFtpExportLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFtpExportLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFtpExportLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFtpExportLogsQuery leftJoinFtpExportBatches($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpExportBatches relation
 * @method     ChildFtpExportLogsQuery rightJoinFtpExportBatches($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpExportBatches relation
 * @method     ChildFtpExportLogsQuery innerJoinFtpExportBatches($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpExportBatches relation
 *
 * @method     ChildFtpExportLogsQuery joinWithFtpExportBatches($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpExportBatches relation
 *
 * @method     ChildFtpExportLogsQuery leftJoinWithFtpExportBatches() Adds a LEFT JOIN clause and with to the query using the FtpExportBatches relation
 * @method     ChildFtpExportLogsQuery rightJoinWithFtpExportBatches() Adds a RIGHT JOIN clause and with to the query using the FtpExportBatches relation
 * @method     ChildFtpExportLogsQuery innerJoinWithFtpExportBatches() Adds a INNER JOIN clause and with to the query using the FtpExportBatches relation
 *
 * @method     ChildFtpExportLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildFtpExportLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildFtpExportLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildFtpExportLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildFtpExportLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpExportLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpExportLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\FtpExportBatchesQuery|\entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFtpExportLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildFtpExportLogs matching the query
 * @method     ChildFtpExportLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFtpExportLogs matching the query, or a new ChildFtpExportLogs object populated from the query conditions when no match is found
 *
 * @method     ChildFtpExportLogs|null findOneByFtpExportLogId(int $ftp_export_log_id) Return the first ChildFtpExportLogs filtered by the ftp_export_log_id column
 * @method     ChildFtpExportLogs|null findOneByFtpExportBatchId(int $ftp_export_batch_id) Return the first ChildFtpExportLogs filtered by the ftp_export_batch_id column
 * @method     ChildFtpExportLogs|null findOneByCompanyId(int $company_id) Return the first ChildFtpExportLogs filtered by the company_id column
 * @method     ChildFtpExportLogs|null findOneByFilePath(string $file_path) Return the first ChildFtpExportLogs filtered by the file_path column
 * @method     ChildFtpExportLogs|null findOneByHasError(int $has_error) Return the first ChildFtpExportLogs filtered by the has_error column
 * @method     ChildFtpExportLogs|null findOneByErrorMessage(string $error_message) Return the first ChildFtpExportLogs filtered by the error_message column
 * @method     ChildFtpExportLogs|null findOneByCreatedAt(string $created_at) Return the first ChildFtpExportLogs filtered by the created_at column
 * @method     ChildFtpExportLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildFtpExportLogs filtered by the updated_at column
 * @method     ChildFtpExportLogs|null findOneByExportStartDate(string $export_start_date) Return the first ChildFtpExportLogs filtered by the export_start_date column
 * @method     ChildFtpExportLogs|null findOneByExportEndDate(string $export_end_date) Return the first ChildFtpExportLogs filtered by the export_end_date column
 * @method     ChildFtpExportLogs|null findOneByIsFileProcessed(int $is_file_processed) Return the first ChildFtpExportLogs filtered by the is_file_processed column
 * @method     ChildFtpExportLogs|null findOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpExportLogs filtered by the is_file_processing column
 * @method     ChildFtpExportLogs|null findOneByNoProcessedRecords(int $no_processed_records) Return the first ChildFtpExportLogs filtered by the no_processed_records column
 * @method     ChildFtpExportLogs|null findOneByStartTime(string $start_time) Return the first ChildFtpExportLogs filtered by the start_time column
 * @method     ChildFtpExportLogs|null findOneByEndTime(string $end_time) Return the first ChildFtpExportLogs filtered by the end_time column
 *
 * @method     ChildFtpExportLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildFtpExportLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOne(?ConnectionInterface $con = null) Return the first ChildFtpExportLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpExportLogs requireOneByFtpExportLogId(int $ftp_export_log_id) Return the first ChildFtpExportLogs filtered by the ftp_export_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByFtpExportBatchId(int $ftp_export_batch_id) Return the first ChildFtpExportLogs filtered by the ftp_export_batch_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByCompanyId(int $company_id) Return the first ChildFtpExportLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByFilePath(string $file_path) Return the first ChildFtpExportLogs filtered by the file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByHasError(int $has_error) Return the first ChildFtpExportLogs filtered by the has_error column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByErrorMessage(string $error_message) Return the first ChildFtpExportLogs filtered by the error_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByCreatedAt(string $created_at) Return the first ChildFtpExportLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildFtpExportLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByExportStartDate(string $export_start_date) Return the first ChildFtpExportLogs filtered by the export_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByExportEndDate(string $export_end_date) Return the first ChildFtpExportLogs filtered by the export_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByIsFileProcessed(int $is_file_processed) Return the first ChildFtpExportLogs filtered by the is_file_processed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByIsFileProcessing(boolean $is_file_processing) Return the first ChildFtpExportLogs filtered by the is_file_processing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByNoProcessedRecords(int $no_processed_records) Return the first ChildFtpExportLogs filtered by the no_processed_records column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByStartTime(string $start_time) Return the first ChildFtpExportLogs filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpExportLogs requireOneByEndTime(string $end_time) Return the first ChildFtpExportLogs filtered by the end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpExportLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildFtpExportLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> find(?ConnectionInterface $con = null) Return ChildFtpExportLogs objects based on current ModelCriteria
 *
 * @method     ChildFtpExportLogs[]|Collection findByFtpExportLogId(int|array<int> $ftp_export_log_id) Return ChildFtpExportLogs objects filtered by the ftp_export_log_id column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByFtpExportLogId(int|array<int> $ftp_export_log_id) Return ChildFtpExportLogs objects filtered by the ftp_export_log_id column
 * @method     ChildFtpExportLogs[]|Collection findByFtpExportBatchId(int|array<int> $ftp_export_batch_id) Return ChildFtpExportLogs objects filtered by the ftp_export_batch_id column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByFtpExportBatchId(int|array<int> $ftp_export_batch_id) Return ChildFtpExportLogs objects filtered by the ftp_export_batch_id column
 * @method     ChildFtpExportLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildFtpExportLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByCompanyId(int|array<int> $company_id) Return ChildFtpExportLogs objects filtered by the company_id column
 * @method     ChildFtpExportLogs[]|Collection findByFilePath(string|array<string> $file_path) Return ChildFtpExportLogs objects filtered by the file_path column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByFilePath(string|array<string> $file_path) Return ChildFtpExportLogs objects filtered by the file_path column
 * @method     ChildFtpExportLogs[]|Collection findByHasError(int|array<int> $has_error) Return ChildFtpExportLogs objects filtered by the has_error column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByHasError(int|array<int> $has_error) Return ChildFtpExportLogs objects filtered by the has_error column
 * @method     ChildFtpExportLogs[]|Collection findByErrorMessage(string|array<string> $error_message) Return ChildFtpExportLogs objects filtered by the error_message column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByErrorMessage(string|array<string> $error_message) Return ChildFtpExportLogs objects filtered by the error_message column
 * @method     ChildFtpExportLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildFtpExportLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByCreatedAt(string|array<string> $created_at) Return ChildFtpExportLogs objects filtered by the created_at column
 * @method     ChildFtpExportLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildFtpExportLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildFtpExportLogs objects filtered by the updated_at column
 * @method     ChildFtpExportLogs[]|Collection findByExportStartDate(string|array<string> $export_start_date) Return ChildFtpExportLogs objects filtered by the export_start_date column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByExportStartDate(string|array<string> $export_start_date) Return ChildFtpExportLogs objects filtered by the export_start_date column
 * @method     ChildFtpExportLogs[]|Collection findByExportEndDate(string|array<string> $export_end_date) Return ChildFtpExportLogs objects filtered by the export_end_date column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByExportEndDate(string|array<string> $export_end_date) Return ChildFtpExportLogs objects filtered by the export_end_date column
 * @method     ChildFtpExportLogs[]|Collection findByIsFileProcessed(int|array<int> $is_file_processed) Return ChildFtpExportLogs objects filtered by the is_file_processed column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByIsFileProcessed(int|array<int> $is_file_processed) Return ChildFtpExportLogs objects filtered by the is_file_processed column
 * @method     ChildFtpExportLogs[]|Collection findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpExportLogs objects filtered by the is_file_processing column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByIsFileProcessing(boolean|array<boolean> $is_file_processing) Return ChildFtpExportLogs objects filtered by the is_file_processing column
 * @method     ChildFtpExportLogs[]|Collection findByNoProcessedRecords(int|array<int> $no_processed_records) Return ChildFtpExportLogs objects filtered by the no_processed_records column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByNoProcessedRecords(int|array<int> $no_processed_records) Return ChildFtpExportLogs objects filtered by the no_processed_records column
 * @method     ChildFtpExportLogs[]|Collection findByStartTime(string|array<string> $start_time) Return ChildFtpExportLogs objects filtered by the start_time column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByStartTime(string|array<string> $start_time) Return ChildFtpExportLogs objects filtered by the start_time column
 * @method     ChildFtpExportLogs[]|Collection findByEndTime(string|array<string> $end_time) Return ChildFtpExportLogs objects filtered by the end_time column
 * @psalm-method Collection&\Traversable<ChildFtpExportLogs> findByEndTime(string|array<string> $end_time) Return ChildFtpExportLogs objects filtered by the end_time column
 *
 * @method     ChildFtpExportLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFtpExportLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class FtpExportLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\FtpExportLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\FtpExportLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFtpExportLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFtpExportLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFtpExportLogsQuery) {
            return $criteria;
        }
        $query = new ChildFtpExportLogsQuery();
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
     * @return ChildFtpExportLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FtpExportLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FtpExportLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFtpExportLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ftp_export_log_id, ftp_export_batch_id, company_id, file_path, has_error, error_message, created_at, updated_at, export_start_date, export_end_date, is_file_processed, is_file_processing, no_processed_records, start_time, end_time FROM ftp_export_logs WHERE ftp_export_log_id = :p0';
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
            /** @var ChildFtpExportLogs $obj */
            $obj = new ChildFtpExportLogs();
            $obj->hydrate($row);
            FtpExportLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFtpExportLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ftp_export_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpExportLogId(1234); // WHERE ftp_export_log_id = 1234
     * $query->filterByFtpExportLogId(array(12, 34)); // WHERE ftp_export_log_id IN (12, 34)
     * $query->filterByFtpExportLogId(array('min' => 12)); // WHERE ftp_export_log_id > 12
     * </code>
     *
     * @param mixed $ftpExportLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportLogId($ftpExportLogId = null, ?string $comparison = null)
    {
        if (is_array($ftpExportLogId)) {
            $useMinMax = false;
            if (isset($ftpExportLogId['min'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $ftpExportLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpExportLogId['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $ftpExportLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $ftpExportLogId, $comparison);

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
     * @see       filterByFtpExportBatches()
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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpExportBatchId['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatchId, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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

        $this->addUsingAlias(FtpExportLogsTableMap::COL_FILE_PATH, $filePath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the has_error column
     *
     * Example usage:
     * <code>
     * $query->filterByHasError(1234); // WHERE has_error = 1234
     * $query->filterByHasError(array(12, 34)); // WHERE has_error IN (12, 34)
     * $query->filterByHasError(array('min' => 12)); // WHERE has_error > 12
     * </code>
     *
     * @param mixed $hasError The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHasError($hasError = null, ?string $comparison = null)
    {
        if (is_array($hasError)) {
            $useMinMax = false;
            if (isset($hasError['min'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_HAS_ERROR, $hasError['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hasError['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_HAS_ERROR, $hasError['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_HAS_ERROR, $hasError, $comparison);

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

        $this->addUsingAlias(FtpExportLogsTableMap::COL_ERROR_MESSAGE, $errorMessage, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the export_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExportStartDate('2011-03-14'); // WHERE export_start_date = '2011-03-14'
     * $query->filterByExportStartDate('now'); // WHERE export_start_date = '2011-03-14'
     * $query->filterByExportStartDate(array('max' => 'yesterday')); // WHERE export_start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $exportStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExportStartDate($exportStartDate = null, ?string $comparison = null)
    {
        if (is_array($exportStartDate)) {
            $useMinMax = false;
            if (isset($exportStartDate['min'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_START_DATE, $exportStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exportStartDate['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_START_DATE, $exportStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_START_DATE, $exportStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the export_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExportEndDate('2011-03-14'); // WHERE export_end_date = '2011-03-14'
     * $query->filterByExportEndDate('now'); // WHERE export_end_date = '2011-03-14'
     * $query->filterByExportEndDate(array('max' => 'yesterday')); // WHERE export_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $exportEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExportEndDate($exportEndDate = null, ?string $comparison = null)
    {
        if (is_array($exportEndDate)) {
            $useMinMax = false;
            if (isset($exportEndDate['min'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_END_DATE, $exportEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exportEndDate['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_END_DATE, $exportEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_EXPORT_END_DATE, $exportEndDate, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isFileProcessed['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_IS_FILE_PROCESSED, $isFileProcessed, $comparison);

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

        $this->addUsingAlias(FtpExportLogsTableMap::COL_IS_FILE_PROCESSING, $isFileProcessing, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noProcessedRecords['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS, $noProcessedRecords, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_START_TIME, $startTime, $comparison);

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
                $this->addUsingAlias(FtpExportLogsTableMap::COL_END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endTime['max'])) {
                $this->addUsingAlias(FtpExportLogsTableMap::COL_END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpExportLogsTableMap::COL_END_TIME, $endTime, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\FtpExportBatches object
     *
     * @param \entities\FtpExportBatches|ObjectCollection $ftpExportBatches The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportBatches($ftpExportBatches, ?string $comparison = null)
    {
        if ($ftpExportBatches instanceof \entities\FtpExportBatches) {
            return $this
                ->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatches->getFtpExportBatchId(), $comparison);
        } elseif ($ftpExportBatches instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, $ftpExportBatches->toKeyValue('PrimaryKey', 'FtpExportBatchId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByFtpExportBatches() only accepts arguments of type \entities\FtpExportBatches or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpExportBatches relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpExportBatches(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpExportBatches');

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
            $this->addJoinObject($join, 'FtpExportBatches');
        }

        return $this;
    }

    /**
     * Use the FtpExportBatches relation FtpExportBatches object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpExportBatchesQuery A secondary query class using the current class as primary query
     */
    public function useFtpExportBatchesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpExportBatches($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpExportBatches', '\entities\FtpExportBatchesQuery');
    }

    /**
     * Use the FtpExportBatches relation FtpExportBatches object
     *
     * @param callable(\entities\FtpExportBatchesQuery):\entities\FtpExportBatchesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpExportBatchesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpExportBatchesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpExportBatches table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the EXISTS statement
     */
    public function useFtpExportBatchesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useExistsQuery('FtpExportBatches', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for a NOT EXISTS query.
     *
     * @see useFtpExportBatchesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpExportBatchesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useExistsQuery('FtpExportBatches', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the IN statement
     */
    public function useInFtpExportBatchesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useInQuery('FtpExportBatches', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for a NOT IN query.
     *
     * @see useFtpExportBatchesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpExportBatchesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useInQuery('FtpExportBatches', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(FtpExportLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpExportLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * @param ChildFtpExportLogs $ftpExportLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ftpExportLogs = null)
    {
        if ($ftpExportLogs) {
            $this->addUsingAlias(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, $ftpExportLogs->getFtpExportLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ftp_export_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FtpExportLogsTableMap::clearInstancePool();
            FtpExportLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FtpExportLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FtpExportLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FtpExportLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
