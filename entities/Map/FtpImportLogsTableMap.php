<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\FtpImportLogs;
use entities\FtpImportLogsQuery;


/**
 * This class defines the structure of the 'ftp_import_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FtpImportLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.FtpImportLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ftp_import_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'FtpImportLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\FtpImportLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.FtpImportLogs';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the ftp_import_log_id field
     */
    public const COL_FTP_IMPORT_LOG_ID = 'ftp_import_logs.ftp_import_log_id';

    /**
     * the column name for the ftp_import_batch_id field
     */
    public const COL_FTP_IMPORT_BATCH_ID = 'ftp_import_logs.ftp_import_batch_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ftp_import_logs.company_id';

    /**
     * the column name for the file_path field
     */
    public const COL_FILE_PATH = 'ftp_import_logs.file_path';

    /**
     * the column name for the no_total_records field
     */
    public const COL_NO_TOTAL_RECORDS = 'ftp_import_logs.no_total_records';

    /**
     * the column name for the no_successful_records field
     */
    public const COL_NO_SUCCESSFUL_RECORDS = 'ftp_import_logs.no_successful_records';

    /**
     * the column name for the no_failed_records field
     */
    public const COL_NO_FAILED_RECORDS = 'ftp_import_logs.no_failed_records';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ftp_import_logs.created_at';

    /**
     * the column name for the is_file_processed field
     */
    public const COL_IS_FILE_PROCESSED = 'ftp_import_logs.is_file_processed';

    /**
     * the column name for the error_message field
     */
    public const COL_ERROR_MESSAGE = 'ftp_import_logs.error_message';

    /**
     * the column name for the is_file_processing field
     */
    public const COL_IS_FILE_PROCESSING = 'ftp_import_logs.is_file_processing';

    /**
     * the column name for the no_processed_records field
     */
    public const COL_NO_PROCESSED_RECORDS = 'ftp_import_logs.no_processed_records';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ftp_import_logs.updated_at';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'ftp_import_logs.start_time';

    /**
     * the column name for the end_time field
     */
    public const COL_END_TIME = 'ftp_import_logs.end_time';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['FtpImportLogId', 'FtpImportBatchId', 'CompanyId', 'FilePath', 'NoTotalRecords', 'NoSuccessfulRecords', 'NoFailedRecords', 'CreatedAt', 'IsFileProcessed', 'ErrorMessage', 'IsFileProcessing', 'NoProcessedRecords', 'UpdatedAt', 'StartTime', 'EndTime', ],
        self::TYPE_CAMELNAME     => ['ftpImportLogId', 'ftpImportBatchId', 'companyId', 'filePath', 'noTotalRecords', 'noSuccessfulRecords', 'noFailedRecords', 'createdAt', 'isFileProcessed', 'errorMessage', 'isFileProcessing', 'noProcessedRecords', 'updatedAt', 'startTime', 'endTime', ],
        self::TYPE_COLNAME       => [FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, FtpImportLogsTableMap::COL_COMPANY_ID, FtpImportLogsTableMap::COL_FILE_PATH, FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS, FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS, FtpImportLogsTableMap::COL_NO_FAILED_RECORDS, FtpImportLogsTableMap::COL_CREATED_AT, FtpImportLogsTableMap::COL_IS_FILE_PROCESSED, FtpImportLogsTableMap::COL_ERROR_MESSAGE, FtpImportLogsTableMap::COL_IS_FILE_PROCESSING, FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS, FtpImportLogsTableMap::COL_UPDATED_AT, FtpImportLogsTableMap::COL_START_TIME, FtpImportLogsTableMap::COL_END_TIME, ],
        self::TYPE_FIELDNAME     => ['ftp_import_log_id', 'ftp_import_batch_id', 'company_id', 'file_path', 'no_total_records', 'no_successful_records', 'no_failed_records', 'created_at', 'is_file_processed', 'error_message', 'is_file_processing', 'no_processed_records', 'updated_at', 'start_time', 'end_time', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['FtpImportLogId' => 0, 'FtpImportBatchId' => 1, 'CompanyId' => 2, 'FilePath' => 3, 'NoTotalRecords' => 4, 'NoSuccessfulRecords' => 5, 'NoFailedRecords' => 6, 'CreatedAt' => 7, 'IsFileProcessed' => 8, 'ErrorMessage' => 9, 'IsFileProcessing' => 10, 'NoProcessedRecords' => 11, 'UpdatedAt' => 12, 'StartTime' => 13, 'EndTime' => 14, ],
        self::TYPE_CAMELNAME     => ['ftpImportLogId' => 0, 'ftpImportBatchId' => 1, 'companyId' => 2, 'filePath' => 3, 'noTotalRecords' => 4, 'noSuccessfulRecords' => 5, 'noFailedRecords' => 6, 'createdAt' => 7, 'isFileProcessed' => 8, 'errorMessage' => 9, 'isFileProcessing' => 10, 'noProcessedRecords' => 11, 'updatedAt' => 12, 'startTime' => 13, 'endTime' => 14, ],
        self::TYPE_COLNAME       => [FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID => 0, FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID => 1, FtpImportLogsTableMap::COL_COMPANY_ID => 2, FtpImportLogsTableMap::COL_FILE_PATH => 3, FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS => 4, FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS => 5, FtpImportLogsTableMap::COL_NO_FAILED_RECORDS => 6, FtpImportLogsTableMap::COL_CREATED_AT => 7, FtpImportLogsTableMap::COL_IS_FILE_PROCESSED => 8, FtpImportLogsTableMap::COL_ERROR_MESSAGE => 9, FtpImportLogsTableMap::COL_IS_FILE_PROCESSING => 10, FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS => 11, FtpImportLogsTableMap::COL_UPDATED_AT => 12, FtpImportLogsTableMap::COL_START_TIME => 13, FtpImportLogsTableMap::COL_END_TIME => 14, ],
        self::TYPE_FIELDNAME     => ['ftp_import_log_id' => 0, 'ftp_import_batch_id' => 1, 'company_id' => 2, 'file_path' => 3, 'no_total_records' => 4, 'no_successful_records' => 5, 'no_failed_records' => 6, 'created_at' => 7, 'is_file_processed' => 8, 'error_message' => 9, 'is_file_processing' => 10, 'no_processed_records' => 11, 'updated_at' => 12, 'start_time' => 13, 'end_time' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FtpImportLogId' => 'FTP_IMPORT_LOG_ID',
        'FtpImportLogs.FtpImportLogId' => 'FTP_IMPORT_LOG_ID',
        'ftpImportLogId' => 'FTP_IMPORT_LOG_ID',
        'ftpImportLogs.ftpImportLogId' => 'FTP_IMPORT_LOG_ID',
        'FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID' => 'FTP_IMPORT_LOG_ID',
        'COL_FTP_IMPORT_LOG_ID' => 'FTP_IMPORT_LOG_ID',
        'ftp_import_log_id' => 'FTP_IMPORT_LOG_ID',
        'ftp_import_logs.ftp_import_log_id' => 'FTP_IMPORT_LOG_ID',
        'FtpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'FtpImportLogs.FtpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'ftpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'ftpImportLogs.ftpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID' => 'FTP_IMPORT_BATCH_ID',
        'COL_FTP_IMPORT_BATCH_ID' => 'FTP_IMPORT_BATCH_ID',
        'ftp_import_batch_id' => 'FTP_IMPORT_BATCH_ID',
        'ftp_import_logs.ftp_import_batch_id' => 'FTP_IMPORT_BATCH_ID',
        'CompanyId' => 'COMPANY_ID',
        'FtpImportLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ftpImportLogs.companyId' => 'COMPANY_ID',
        'FtpImportLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ftp_import_logs.company_id' => 'COMPANY_ID',
        'FilePath' => 'FILE_PATH',
        'FtpImportLogs.FilePath' => 'FILE_PATH',
        'filePath' => 'FILE_PATH',
        'ftpImportLogs.filePath' => 'FILE_PATH',
        'FtpImportLogsTableMap::COL_FILE_PATH' => 'FILE_PATH',
        'COL_FILE_PATH' => 'FILE_PATH',
        'file_path' => 'FILE_PATH',
        'ftp_import_logs.file_path' => 'FILE_PATH',
        'NoTotalRecords' => 'NO_TOTAL_RECORDS',
        'FtpImportLogs.NoTotalRecords' => 'NO_TOTAL_RECORDS',
        'noTotalRecords' => 'NO_TOTAL_RECORDS',
        'ftpImportLogs.noTotalRecords' => 'NO_TOTAL_RECORDS',
        'FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS' => 'NO_TOTAL_RECORDS',
        'COL_NO_TOTAL_RECORDS' => 'NO_TOTAL_RECORDS',
        'no_total_records' => 'NO_TOTAL_RECORDS',
        'ftp_import_logs.no_total_records' => 'NO_TOTAL_RECORDS',
        'NoSuccessfulRecords' => 'NO_SUCCESSFUL_RECORDS',
        'FtpImportLogs.NoSuccessfulRecords' => 'NO_SUCCESSFUL_RECORDS',
        'noSuccessfulRecords' => 'NO_SUCCESSFUL_RECORDS',
        'ftpImportLogs.noSuccessfulRecords' => 'NO_SUCCESSFUL_RECORDS',
        'FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS' => 'NO_SUCCESSFUL_RECORDS',
        'COL_NO_SUCCESSFUL_RECORDS' => 'NO_SUCCESSFUL_RECORDS',
        'no_successful_records' => 'NO_SUCCESSFUL_RECORDS',
        'ftp_import_logs.no_successful_records' => 'NO_SUCCESSFUL_RECORDS',
        'NoFailedRecords' => 'NO_FAILED_RECORDS',
        'FtpImportLogs.NoFailedRecords' => 'NO_FAILED_RECORDS',
        'noFailedRecords' => 'NO_FAILED_RECORDS',
        'ftpImportLogs.noFailedRecords' => 'NO_FAILED_RECORDS',
        'FtpImportLogsTableMap::COL_NO_FAILED_RECORDS' => 'NO_FAILED_RECORDS',
        'COL_NO_FAILED_RECORDS' => 'NO_FAILED_RECORDS',
        'no_failed_records' => 'NO_FAILED_RECORDS',
        'ftp_import_logs.no_failed_records' => 'NO_FAILED_RECORDS',
        'CreatedAt' => 'CREATED_AT',
        'FtpImportLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ftpImportLogs.createdAt' => 'CREATED_AT',
        'FtpImportLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ftp_import_logs.created_at' => 'CREATED_AT',
        'IsFileProcessed' => 'IS_FILE_PROCESSED',
        'FtpImportLogs.IsFileProcessed' => 'IS_FILE_PROCESSED',
        'isFileProcessed' => 'IS_FILE_PROCESSED',
        'ftpImportLogs.isFileProcessed' => 'IS_FILE_PROCESSED',
        'FtpImportLogsTableMap::COL_IS_FILE_PROCESSED' => 'IS_FILE_PROCESSED',
        'COL_IS_FILE_PROCESSED' => 'IS_FILE_PROCESSED',
        'is_file_processed' => 'IS_FILE_PROCESSED',
        'ftp_import_logs.is_file_processed' => 'IS_FILE_PROCESSED',
        'ErrorMessage' => 'ERROR_MESSAGE',
        'FtpImportLogs.ErrorMessage' => 'ERROR_MESSAGE',
        'errorMessage' => 'ERROR_MESSAGE',
        'ftpImportLogs.errorMessage' => 'ERROR_MESSAGE',
        'FtpImportLogsTableMap::COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'error_message' => 'ERROR_MESSAGE',
        'ftp_import_logs.error_message' => 'ERROR_MESSAGE',
        'IsFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpImportLogs.IsFileProcessing' => 'IS_FILE_PROCESSING',
        'isFileProcessing' => 'IS_FILE_PROCESSING',
        'ftpImportLogs.isFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpImportLogsTableMap::COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'is_file_processing' => 'IS_FILE_PROCESSING',
        'ftp_import_logs.is_file_processing' => 'IS_FILE_PROCESSING',
        'NoProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'FtpImportLogs.NoProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'noProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'ftpImportLogs.noProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS' => 'NO_PROCESSED_RECORDS',
        'COL_NO_PROCESSED_RECORDS' => 'NO_PROCESSED_RECORDS',
        'no_processed_records' => 'NO_PROCESSED_RECORDS',
        'ftp_import_logs.no_processed_records' => 'NO_PROCESSED_RECORDS',
        'UpdatedAt' => 'UPDATED_AT',
        'FtpImportLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'ftpImportLogs.updatedAt' => 'UPDATED_AT',
        'FtpImportLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ftp_import_logs.updated_at' => 'UPDATED_AT',
        'StartTime' => 'START_TIME',
        'FtpImportLogs.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'ftpImportLogs.startTime' => 'START_TIME',
        'FtpImportLogsTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'ftp_import_logs.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'FtpImportLogs.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'ftpImportLogs.endTime' => 'END_TIME',
        'FtpImportLogsTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'ftp_import_logs.end_time' => 'END_TIME',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('ftp_import_logs');
        $this->setPhpName('FtpImportLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\FtpImportLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ftp_import_logs_ftp_import_log_id_seq');
        // columns
        $this->addPrimaryKey('ftp_import_log_id', 'FtpImportLogId', 'BIGINT', true, null, null);
        $this->addForeignKey('ftp_import_batch_id', 'FtpImportBatchId', 'INTEGER', 'ftp_import_batches', 'ftp_import_batch_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('file_path', 'FilePath', 'LONGVARCHAR', false, null, null);
        $this->addColumn('no_total_records', 'NoTotalRecords', 'INTEGER', false, null, 0);
        $this->addColumn('no_successful_records', 'NoSuccessfulRecords', 'INTEGER', false, null, 0);
        $this->addColumn('no_failed_records', 'NoFailedRecords', 'INTEGER', false, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('is_file_processed', 'IsFileProcessed', 'SMALLINT', false, null, 1);
        $this->addColumn('error_message', 'ErrorMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('is_file_processing', 'IsFileProcessing', 'BOOLEAN', false, 1, false);
        $this->addColumn('no_processed_records', 'NoProcessedRecords', 'INTEGER', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('start_time', 'StartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('end_time', 'EndTime', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('FtpImportBatches', '\\entities\\FtpImportBatches', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ftp_import_batch_id',
    1 => ':ftp_import_batch_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? FtpImportLogsTableMap::CLASS_DEFAULT : FtpImportLogsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (FtpImportLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = FtpImportLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FtpImportLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FtpImportLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FtpImportLogsTableMap::OM_CLASS;
            /** @var FtpImportLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FtpImportLogsTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FtpImportLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FtpImportLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FtpImportLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FtpImportLogsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_FILE_PATH);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_ERROR_MESSAGE);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_START_TIME);
            $criteria->addSelectColumn(FtpImportLogsTableMap::COL_END_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.ftp_import_log_id');
            $criteria->addSelectColumn($alias . '.ftp_import_batch_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.file_path');
            $criteria->addSelectColumn($alias . '.no_total_records');
            $criteria->addSelectColumn($alias . '.no_successful_records');
            $criteria->addSelectColumn($alias . '.no_failed_records');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.is_file_processed');
            $criteria->addSelectColumn($alias . '.error_message');
            $criteria->addSelectColumn($alias . '.is_file_processing');
            $criteria->addSelectColumn($alias . '.no_processed_records');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.end_time');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_FILE_PATH);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_ERROR_MESSAGE);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(FtpImportLogsTableMap::COL_END_TIME);
        } else {
            $criteria->removeSelectColumn($alias . '.ftp_import_log_id');
            $criteria->removeSelectColumn($alias . '.ftp_import_batch_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.file_path');
            $criteria->removeSelectColumn($alias . '.no_total_records');
            $criteria->removeSelectColumn($alias . '.no_successful_records');
            $criteria->removeSelectColumn($alias . '.no_failed_records');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.is_file_processed');
            $criteria->removeSelectColumn($alias . '.error_message');
            $criteria->removeSelectColumn($alias . '.is_file_processing');
            $criteria->removeSelectColumn($alias . '.no_processed_records');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.end_time');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(FtpImportLogsTableMap::DATABASE_NAME)->getTable(FtpImportLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a FtpImportLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or FtpImportLogs object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\FtpImportLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FtpImportLogsTableMap::DATABASE_NAME);
            $criteria->add(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = FtpImportLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FtpImportLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FtpImportLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ftp_import_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return FtpImportLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FtpImportLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or FtpImportLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FtpImportLogs object
        }

        if ($criteria->containsKey(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID) && $criteria->keyContainsValue(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID.')');
        }


        // Set the correct dbName
        $query = FtpImportLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
