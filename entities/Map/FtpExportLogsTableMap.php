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
use entities\FtpExportLogs;
use entities\FtpExportLogsQuery;


/**
 * This class defines the structure of the 'ftp_export_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FtpExportLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.FtpExportLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ftp_export_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'FtpExportLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\FtpExportLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.FtpExportLogs';

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
     * the column name for the ftp_export_log_id field
     */
    public const COL_FTP_EXPORT_LOG_ID = 'ftp_export_logs.ftp_export_log_id';

    /**
     * the column name for the ftp_export_batch_id field
     */
    public const COL_FTP_EXPORT_BATCH_ID = 'ftp_export_logs.ftp_export_batch_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ftp_export_logs.company_id';

    /**
     * the column name for the file_path field
     */
    public const COL_FILE_PATH = 'ftp_export_logs.file_path';

    /**
     * the column name for the has_error field
     */
    public const COL_HAS_ERROR = 'ftp_export_logs.has_error';

    /**
     * the column name for the error_message field
     */
    public const COL_ERROR_MESSAGE = 'ftp_export_logs.error_message';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ftp_export_logs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ftp_export_logs.updated_at';

    /**
     * the column name for the export_start_date field
     */
    public const COL_EXPORT_START_DATE = 'ftp_export_logs.export_start_date';

    /**
     * the column name for the export_end_date field
     */
    public const COL_EXPORT_END_DATE = 'ftp_export_logs.export_end_date';

    /**
     * the column name for the is_file_processed field
     */
    public const COL_IS_FILE_PROCESSED = 'ftp_export_logs.is_file_processed';

    /**
     * the column name for the is_file_processing field
     */
    public const COL_IS_FILE_PROCESSING = 'ftp_export_logs.is_file_processing';

    /**
     * the column name for the no_processed_records field
     */
    public const COL_NO_PROCESSED_RECORDS = 'ftp_export_logs.no_processed_records';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'ftp_export_logs.start_time';

    /**
     * the column name for the end_time field
     */
    public const COL_END_TIME = 'ftp_export_logs.end_time';

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
        self::TYPE_PHPNAME       => ['FtpExportLogId', 'FtpExportBatchId', 'CompanyId', 'FilePath', 'HasError', 'ErrorMessage', 'CreatedAt', 'UpdatedAt', 'ExportStartDate', 'ExportEndDate', 'IsFileProcessed', 'IsFileProcessing', 'NoProcessedRecords', 'StartTime', 'EndTime', ],
        self::TYPE_CAMELNAME     => ['ftpExportLogId', 'ftpExportBatchId', 'companyId', 'filePath', 'hasError', 'errorMessage', 'createdAt', 'updatedAt', 'exportStartDate', 'exportEndDate', 'isFileProcessed', 'isFileProcessing', 'noProcessedRecords', 'startTime', 'endTime', ],
        self::TYPE_COLNAME       => [FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID, FtpExportLogsTableMap::COL_COMPANY_ID, FtpExportLogsTableMap::COL_FILE_PATH, FtpExportLogsTableMap::COL_HAS_ERROR, FtpExportLogsTableMap::COL_ERROR_MESSAGE, FtpExportLogsTableMap::COL_CREATED_AT, FtpExportLogsTableMap::COL_UPDATED_AT, FtpExportLogsTableMap::COL_EXPORT_START_DATE, FtpExportLogsTableMap::COL_EXPORT_END_DATE, FtpExportLogsTableMap::COL_IS_FILE_PROCESSED, FtpExportLogsTableMap::COL_IS_FILE_PROCESSING, FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS, FtpExportLogsTableMap::COL_START_TIME, FtpExportLogsTableMap::COL_END_TIME, ],
        self::TYPE_FIELDNAME     => ['ftp_export_log_id', 'ftp_export_batch_id', 'company_id', 'file_path', 'has_error', 'error_message', 'created_at', 'updated_at', 'export_start_date', 'export_end_date', 'is_file_processed', 'is_file_processing', 'no_processed_records', 'start_time', 'end_time', ],
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
        self::TYPE_PHPNAME       => ['FtpExportLogId' => 0, 'FtpExportBatchId' => 1, 'CompanyId' => 2, 'FilePath' => 3, 'HasError' => 4, 'ErrorMessage' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'ExportStartDate' => 8, 'ExportEndDate' => 9, 'IsFileProcessed' => 10, 'IsFileProcessing' => 11, 'NoProcessedRecords' => 12, 'StartTime' => 13, 'EndTime' => 14, ],
        self::TYPE_CAMELNAME     => ['ftpExportLogId' => 0, 'ftpExportBatchId' => 1, 'companyId' => 2, 'filePath' => 3, 'hasError' => 4, 'errorMessage' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'exportStartDate' => 8, 'exportEndDate' => 9, 'isFileProcessed' => 10, 'isFileProcessing' => 11, 'noProcessedRecords' => 12, 'startTime' => 13, 'endTime' => 14, ],
        self::TYPE_COLNAME       => [FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID => 0, FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID => 1, FtpExportLogsTableMap::COL_COMPANY_ID => 2, FtpExportLogsTableMap::COL_FILE_PATH => 3, FtpExportLogsTableMap::COL_HAS_ERROR => 4, FtpExportLogsTableMap::COL_ERROR_MESSAGE => 5, FtpExportLogsTableMap::COL_CREATED_AT => 6, FtpExportLogsTableMap::COL_UPDATED_AT => 7, FtpExportLogsTableMap::COL_EXPORT_START_DATE => 8, FtpExportLogsTableMap::COL_EXPORT_END_DATE => 9, FtpExportLogsTableMap::COL_IS_FILE_PROCESSED => 10, FtpExportLogsTableMap::COL_IS_FILE_PROCESSING => 11, FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS => 12, FtpExportLogsTableMap::COL_START_TIME => 13, FtpExportLogsTableMap::COL_END_TIME => 14, ],
        self::TYPE_FIELDNAME     => ['ftp_export_log_id' => 0, 'ftp_export_batch_id' => 1, 'company_id' => 2, 'file_path' => 3, 'has_error' => 4, 'error_message' => 5, 'created_at' => 6, 'updated_at' => 7, 'export_start_date' => 8, 'export_end_date' => 9, 'is_file_processed' => 10, 'is_file_processing' => 11, 'no_processed_records' => 12, 'start_time' => 13, 'end_time' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FtpExportLogId' => 'FTP_EXPORT_LOG_ID',
        'FtpExportLogs.FtpExportLogId' => 'FTP_EXPORT_LOG_ID',
        'ftpExportLogId' => 'FTP_EXPORT_LOG_ID',
        'ftpExportLogs.ftpExportLogId' => 'FTP_EXPORT_LOG_ID',
        'FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID' => 'FTP_EXPORT_LOG_ID',
        'COL_FTP_EXPORT_LOG_ID' => 'FTP_EXPORT_LOG_ID',
        'ftp_export_log_id' => 'FTP_EXPORT_LOG_ID',
        'ftp_export_logs.ftp_export_log_id' => 'FTP_EXPORT_LOG_ID',
        'FtpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'FtpExportLogs.FtpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'ftpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'ftpExportLogs.ftpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID' => 'FTP_EXPORT_BATCH_ID',
        'COL_FTP_EXPORT_BATCH_ID' => 'FTP_EXPORT_BATCH_ID',
        'ftp_export_batch_id' => 'FTP_EXPORT_BATCH_ID',
        'ftp_export_logs.ftp_export_batch_id' => 'FTP_EXPORT_BATCH_ID',
        'CompanyId' => 'COMPANY_ID',
        'FtpExportLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ftpExportLogs.companyId' => 'COMPANY_ID',
        'FtpExportLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ftp_export_logs.company_id' => 'COMPANY_ID',
        'FilePath' => 'FILE_PATH',
        'FtpExportLogs.FilePath' => 'FILE_PATH',
        'filePath' => 'FILE_PATH',
        'ftpExportLogs.filePath' => 'FILE_PATH',
        'FtpExportLogsTableMap::COL_FILE_PATH' => 'FILE_PATH',
        'COL_FILE_PATH' => 'FILE_PATH',
        'file_path' => 'FILE_PATH',
        'ftp_export_logs.file_path' => 'FILE_PATH',
        'HasError' => 'HAS_ERROR',
        'FtpExportLogs.HasError' => 'HAS_ERROR',
        'hasError' => 'HAS_ERROR',
        'ftpExportLogs.hasError' => 'HAS_ERROR',
        'FtpExportLogsTableMap::COL_HAS_ERROR' => 'HAS_ERROR',
        'COL_HAS_ERROR' => 'HAS_ERROR',
        'has_error' => 'HAS_ERROR',
        'ftp_export_logs.has_error' => 'HAS_ERROR',
        'ErrorMessage' => 'ERROR_MESSAGE',
        'FtpExportLogs.ErrorMessage' => 'ERROR_MESSAGE',
        'errorMessage' => 'ERROR_MESSAGE',
        'ftpExportLogs.errorMessage' => 'ERROR_MESSAGE',
        'FtpExportLogsTableMap::COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'error_message' => 'ERROR_MESSAGE',
        'ftp_export_logs.error_message' => 'ERROR_MESSAGE',
        'CreatedAt' => 'CREATED_AT',
        'FtpExportLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ftpExportLogs.createdAt' => 'CREATED_AT',
        'FtpExportLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ftp_export_logs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'FtpExportLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'ftpExportLogs.updatedAt' => 'UPDATED_AT',
        'FtpExportLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ftp_export_logs.updated_at' => 'UPDATED_AT',
        'ExportStartDate' => 'EXPORT_START_DATE',
        'FtpExportLogs.ExportStartDate' => 'EXPORT_START_DATE',
        'exportStartDate' => 'EXPORT_START_DATE',
        'ftpExportLogs.exportStartDate' => 'EXPORT_START_DATE',
        'FtpExportLogsTableMap::COL_EXPORT_START_DATE' => 'EXPORT_START_DATE',
        'COL_EXPORT_START_DATE' => 'EXPORT_START_DATE',
        'export_start_date' => 'EXPORT_START_DATE',
        'ftp_export_logs.export_start_date' => 'EXPORT_START_DATE',
        'ExportEndDate' => 'EXPORT_END_DATE',
        'FtpExportLogs.ExportEndDate' => 'EXPORT_END_DATE',
        'exportEndDate' => 'EXPORT_END_DATE',
        'ftpExportLogs.exportEndDate' => 'EXPORT_END_DATE',
        'FtpExportLogsTableMap::COL_EXPORT_END_DATE' => 'EXPORT_END_DATE',
        'COL_EXPORT_END_DATE' => 'EXPORT_END_DATE',
        'export_end_date' => 'EXPORT_END_DATE',
        'ftp_export_logs.export_end_date' => 'EXPORT_END_DATE',
        'IsFileProcessed' => 'IS_FILE_PROCESSED',
        'FtpExportLogs.IsFileProcessed' => 'IS_FILE_PROCESSED',
        'isFileProcessed' => 'IS_FILE_PROCESSED',
        'ftpExportLogs.isFileProcessed' => 'IS_FILE_PROCESSED',
        'FtpExportLogsTableMap::COL_IS_FILE_PROCESSED' => 'IS_FILE_PROCESSED',
        'COL_IS_FILE_PROCESSED' => 'IS_FILE_PROCESSED',
        'is_file_processed' => 'IS_FILE_PROCESSED',
        'ftp_export_logs.is_file_processed' => 'IS_FILE_PROCESSED',
        'IsFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpExportLogs.IsFileProcessing' => 'IS_FILE_PROCESSING',
        'isFileProcessing' => 'IS_FILE_PROCESSING',
        'ftpExportLogs.isFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpExportLogsTableMap::COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'is_file_processing' => 'IS_FILE_PROCESSING',
        'ftp_export_logs.is_file_processing' => 'IS_FILE_PROCESSING',
        'NoProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'FtpExportLogs.NoProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'noProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'ftpExportLogs.noProcessedRecords' => 'NO_PROCESSED_RECORDS',
        'FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS' => 'NO_PROCESSED_RECORDS',
        'COL_NO_PROCESSED_RECORDS' => 'NO_PROCESSED_RECORDS',
        'no_processed_records' => 'NO_PROCESSED_RECORDS',
        'ftp_export_logs.no_processed_records' => 'NO_PROCESSED_RECORDS',
        'StartTime' => 'START_TIME',
        'FtpExportLogs.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'ftpExportLogs.startTime' => 'START_TIME',
        'FtpExportLogsTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'ftp_export_logs.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'FtpExportLogs.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'ftpExportLogs.endTime' => 'END_TIME',
        'FtpExportLogsTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'ftp_export_logs.end_time' => 'END_TIME',
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
        $this->setName('ftp_export_logs');
        $this->setPhpName('FtpExportLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\FtpExportLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ftp_export_logs_ftp_export_log_id_seq');
        // columns
        $this->addPrimaryKey('ftp_export_log_id', 'FtpExportLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('ftp_export_batch_id', 'FtpExportBatchId', 'INTEGER', 'ftp_export_batches', 'ftp_export_batch_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('file_path', 'FilePath', 'LONGVARCHAR', false, null, null);
        $this->addColumn('has_error', 'HasError', 'SMALLINT', false, null, null);
        $this->addColumn('error_message', 'ErrorMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('export_start_date', 'ExportStartDate', 'DATE', false, null, null);
        $this->addColumn('export_end_date', 'ExportEndDate', 'DATE', false, null, null);
        $this->addColumn('is_file_processed', 'IsFileProcessed', 'SMALLINT', false, null, 1);
        $this->addColumn('is_file_processing', 'IsFileProcessing', 'BOOLEAN', false, 1, false);
        $this->addColumn('no_processed_records', 'NoProcessedRecords', 'INTEGER', false, null, null);
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
        $this->addRelation('FtpExportBatches', '\\entities\\FtpExportBatches', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ftp_export_batch_id',
    1 => ':ftp_export_batch_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('FtpExportLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FtpExportLogsTableMap::CLASS_DEFAULT : FtpExportLogsTableMap::OM_CLASS;
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
     * @return array (FtpExportLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = FtpExportLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FtpExportLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FtpExportLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FtpExportLogsTableMap::OM_CLASS;
            /** @var FtpExportLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FtpExportLogsTableMap::addInstanceToPool($obj, $key);
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
            $key = FtpExportLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FtpExportLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FtpExportLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FtpExportLogsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_FILE_PATH);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_HAS_ERROR);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_ERROR_MESSAGE);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_EXPORT_START_DATE);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_EXPORT_END_DATE);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_IS_FILE_PROCESSED);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_IS_FILE_PROCESSING);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_START_TIME);
            $criteria->addSelectColumn(FtpExportLogsTableMap::COL_END_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.ftp_export_log_id');
            $criteria->addSelectColumn($alias . '.ftp_export_batch_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.file_path');
            $criteria->addSelectColumn($alias . '.has_error');
            $criteria->addSelectColumn($alias . '.error_message');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.export_start_date');
            $criteria->addSelectColumn($alias . '.export_end_date');
            $criteria->addSelectColumn($alias . '.is_file_processed');
            $criteria->addSelectColumn($alias . '.is_file_processing');
            $criteria->addSelectColumn($alias . '.no_processed_records');
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
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_FTP_EXPORT_BATCH_ID);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_FILE_PATH);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_HAS_ERROR);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_ERROR_MESSAGE);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_EXPORT_START_DATE);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_EXPORT_END_DATE);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_IS_FILE_PROCESSED);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_IS_FILE_PROCESSING);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_NO_PROCESSED_RECORDS);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(FtpExportLogsTableMap::COL_END_TIME);
        } else {
            $criteria->removeSelectColumn($alias . '.ftp_export_log_id');
            $criteria->removeSelectColumn($alias . '.ftp_export_batch_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.file_path');
            $criteria->removeSelectColumn($alias . '.has_error');
            $criteria->removeSelectColumn($alias . '.error_message');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.export_start_date');
            $criteria->removeSelectColumn($alias . '.export_end_date');
            $criteria->removeSelectColumn($alias . '.is_file_processed');
            $criteria->removeSelectColumn($alias . '.is_file_processing');
            $criteria->removeSelectColumn($alias . '.no_processed_records');
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
        return Propel::getServiceContainer()->getDatabaseMap(FtpExportLogsTableMap::DATABASE_NAME)->getTable(FtpExportLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a FtpExportLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or FtpExportLogs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\FtpExportLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FtpExportLogsTableMap::DATABASE_NAME);
            $criteria->add(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = FtpExportLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FtpExportLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FtpExportLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ftp_export_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return FtpExportLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FtpExportLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or FtpExportLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FtpExportLogs object
        }

        if ($criteria->containsKey(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID) && $criteria->keyContainsValue(FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FtpExportLogsTableMap::COL_FTP_EXPORT_LOG_ID.')');
        }


        // Set the correct dbName
        $query = FtpExportLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
