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
use entities\FtpExportBatches;
use entities\FtpExportBatchesQuery;


/**
 * This class defines the structure of the 'ftp_export_batches' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FtpExportBatchesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.FtpExportBatchesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ftp_export_batches';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'FtpExportBatches';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\FtpExportBatches';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.FtpExportBatches';

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
     * the column name for the ftp_export_batch_id field
     */
    public const COL_FTP_EXPORT_BATCH_ID = 'ftp_export_batches.ftp_export_batch_id';

    /**
     * the column name for the label field
     */
    public const COL_LABEL = 'ftp_export_batches.label';

    /**
     * the column name for the attached_function field
     */
    public const COL_ATTACHED_FUNCTION = 'ftp_export_batches.attached_function';

    /**
     * the column name for the next_date field
     */
    public const COL_NEXT_DATE = 'ftp_export_batches.next_date';

    /**
     * the column name for the interval_days field
     */
    public const COL_INTERVAL_DAYS = 'ftp_export_batches.interval_days';

    /**
     * the column name for the ftp_path field
     */
    public const COL_FTP_PATH = 'ftp_export_batches.ftp_path';

    /**
     * the column name for the isenabled field
     */
    public const COL_ISENABLED = 'ftp_export_batches.isenabled';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ftp_export_batches.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ftp_export_batches.created_at';

    /**
     * the column name for the file_name_format field
     */
    public const COL_FILE_NAME_FORMAT = 'ftp_export_batches.file_name_format';

    /**
     * the column name for the is_file_processing field
     */
    public const COL_IS_FILE_PROCESSING = 'ftp_export_batches.is_file_processing';

    /**
     * the column name for the ftp_order field
     */
    public const COL_FTP_ORDER = 'ftp_export_batches.ftp_order';

    /**
     * the column name for the interval_type field
     */
    public const COL_INTERVAL_TYPE = 'ftp_export_batches.interval_type';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'ftp_export_batches.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'ftp_export_batches.end_date';

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
        self::TYPE_PHPNAME       => ['FtpExportBatchId', 'Label', 'AttachedFunction', 'NextDate', 'IntervalDays', 'FtpPath', 'Isenabled', 'CompanyId', 'CreatedAt', 'FileNameFormat', 'IsFileProcessing', 'FtpOrder', 'IntervalType', 'StartDate', 'EndDate', ],
        self::TYPE_CAMELNAME     => ['ftpExportBatchId', 'label', 'attachedFunction', 'nextDate', 'intervalDays', 'ftpPath', 'isenabled', 'companyId', 'createdAt', 'fileNameFormat', 'isFileProcessing', 'ftpOrder', 'intervalType', 'startDate', 'endDate', ],
        self::TYPE_COLNAME       => [FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, FtpExportBatchesTableMap::COL_LABEL, FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION, FtpExportBatchesTableMap::COL_NEXT_DATE, FtpExportBatchesTableMap::COL_INTERVAL_DAYS, FtpExportBatchesTableMap::COL_FTP_PATH, FtpExportBatchesTableMap::COL_ISENABLED, FtpExportBatchesTableMap::COL_COMPANY_ID, FtpExportBatchesTableMap::COL_CREATED_AT, FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT, FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING, FtpExportBatchesTableMap::COL_FTP_ORDER, FtpExportBatchesTableMap::COL_INTERVAL_TYPE, FtpExportBatchesTableMap::COL_START_DATE, FtpExportBatchesTableMap::COL_END_DATE, ],
        self::TYPE_FIELDNAME     => ['ftp_export_batch_id', 'label', 'attached_function', 'next_date', 'interval_days', 'ftp_path', 'isenabled', 'company_id', 'created_at', 'file_name_format', 'is_file_processing', 'ftp_order', 'interval_type', 'start_date', 'end_date', ],
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
        self::TYPE_PHPNAME       => ['FtpExportBatchId' => 0, 'Label' => 1, 'AttachedFunction' => 2, 'NextDate' => 3, 'IntervalDays' => 4, 'FtpPath' => 5, 'Isenabled' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'FileNameFormat' => 9, 'IsFileProcessing' => 10, 'FtpOrder' => 11, 'IntervalType' => 12, 'StartDate' => 13, 'EndDate' => 14, ],
        self::TYPE_CAMELNAME     => ['ftpExportBatchId' => 0, 'label' => 1, 'attachedFunction' => 2, 'nextDate' => 3, 'intervalDays' => 4, 'ftpPath' => 5, 'isenabled' => 6, 'companyId' => 7, 'createdAt' => 8, 'fileNameFormat' => 9, 'isFileProcessing' => 10, 'ftpOrder' => 11, 'intervalType' => 12, 'startDate' => 13, 'endDate' => 14, ],
        self::TYPE_COLNAME       => [FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID => 0, FtpExportBatchesTableMap::COL_LABEL => 1, FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION => 2, FtpExportBatchesTableMap::COL_NEXT_DATE => 3, FtpExportBatchesTableMap::COL_INTERVAL_DAYS => 4, FtpExportBatchesTableMap::COL_FTP_PATH => 5, FtpExportBatchesTableMap::COL_ISENABLED => 6, FtpExportBatchesTableMap::COL_COMPANY_ID => 7, FtpExportBatchesTableMap::COL_CREATED_AT => 8, FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT => 9, FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING => 10, FtpExportBatchesTableMap::COL_FTP_ORDER => 11, FtpExportBatchesTableMap::COL_INTERVAL_TYPE => 12, FtpExportBatchesTableMap::COL_START_DATE => 13, FtpExportBatchesTableMap::COL_END_DATE => 14, ],
        self::TYPE_FIELDNAME     => ['ftp_export_batch_id' => 0, 'label' => 1, 'attached_function' => 2, 'next_date' => 3, 'interval_days' => 4, 'ftp_path' => 5, 'isenabled' => 6, 'company_id' => 7, 'created_at' => 8, 'file_name_format' => 9, 'is_file_processing' => 10, 'ftp_order' => 11, 'interval_type' => 12, 'start_date' => 13, 'end_date' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FtpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'FtpExportBatches.FtpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'ftpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'ftpExportBatches.ftpExportBatchId' => 'FTP_EXPORT_BATCH_ID',
        'FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID' => 'FTP_EXPORT_BATCH_ID',
        'COL_FTP_EXPORT_BATCH_ID' => 'FTP_EXPORT_BATCH_ID',
        'ftp_export_batch_id' => 'FTP_EXPORT_BATCH_ID',
        'ftp_export_batches.ftp_export_batch_id' => 'FTP_EXPORT_BATCH_ID',
        'Label' => 'LABEL',
        'FtpExportBatches.Label' => 'LABEL',
        'label' => 'LABEL',
        'ftpExportBatches.label' => 'LABEL',
        'FtpExportBatchesTableMap::COL_LABEL' => 'LABEL',
        'COL_LABEL' => 'LABEL',
        'ftp_export_batches.label' => 'LABEL',
        'AttachedFunction' => 'ATTACHED_FUNCTION',
        'FtpExportBatches.AttachedFunction' => 'ATTACHED_FUNCTION',
        'attachedFunction' => 'ATTACHED_FUNCTION',
        'ftpExportBatches.attachedFunction' => 'ATTACHED_FUNCTION',
        'FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION' => 'ATTACHED_FUNCTION',
        'COL_ATTACHED_FUNCTION' => 'ATTACHED_FUNCTION',
        'attached_function' => 'ATTACHED_FUNCTION',
        'ftp_export_batches.attached_function' => 'ATTACHED_FUNCTION',
        'NextDate' => 'NEXT_DATE',
        'FtpExportBatches.NextDate' => 'NEXT_DATE',
        'nextDate' => 'NEXT_DATE',
        'ftpExportBatches.nextDate' => 'NEXT_DATE',
        'FtpExportBatchesTableMap::COL_NEXT_DATE' => 'NEXT_DATE',
        'COL_NEXT_DATE' => 'NEXT_DATE',
        'next_date' => 'NEXT_DATE',
        'ftp_export_batches.next_date' => 'NEXT_DATE',
        'IntervalDays' => 'INTERVAL_DAYS',
        'FtpExportBatches.IntervalDays' => 'INTERVAL_DAYS',
        'intervalDays' => 'INTERVAL_DAYS',
        'ftpExportBatches.intervalDays' => 'INTERVAL_DAYS',
        'FtpExportBatchesTableMap::COL_INTERVAL_DAYS' => 'INTERVAL_DAYS',
        'COL_INTERVAL_DAYS' => 'INTERVAL_DAYS',
        'interval_days' => 'INTERVAL_DAYS',
        'ftp_export_batches.interval_days' => 'INTERVAL_DAYS',
        'FtpPath' => 'FTP_PATH',
        'FtpExportBatches.FtpPath' => 'FTP_PATH',
        'ftpPath' => 'FTP_PATH',
        'ftpExportBatches.ftpPath' => 'FTP_PATH',
        'FtpExportBatchesTableMap::COL_FTP_PATH' => 'FTP_PATH',
        'COL_FTP_PATH' => 'FTP_PATH',
        'ftp_path' => 'FTP_PATH',
        'ftp_export_batches.ftp_path' => 'FTP_PATH',
        'Isenabled' => 'ISENABLED',
        'FtpExportBatches.Isenabled' => 'ISENABLED',
        'isenabled' => 'ISENABLED',
        'ftpExportBatches.isenabled' => 'ISENABLED',
        'FtpExportBatchesTableMap::COL_ISENABLED' => 'ISENABLED',
        'COL_ISENABLED' => 'ISENABLED',
        'ftp_export_batches.isenabled' => 'ISENABLED',
        'CompanyId' => 'COMPANY_ID',
        'FtpExportBatches.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ftpExportBatches.companyId' => 'COMPANY_ID',
        'FtpExportBatchesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ftp_export_batches.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'FtpExportBatches.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ftpExportBatches.createdAt' => 'CREATED_AT',
        'FtpExportBatchesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ftp_export_batches.created_at' => 'CREATED_AT',
        'FileNameFormat' => 'FILE_NAME_FORMAT',
        'FtpExportBatches.FileNameFormat' => 'FILE_NAME_FORMAT',
        'fileNameFormat' => 'FILE_NAME_FORMAT',
        'ftpExportBatches.fileNameFormat' => 'FILE_NAME_FORMAT',
        'FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT' => 'FILE_NAME_FORMAT',
        'COL_FILE_NAME_FORMAT' => 'FILE_NAME_FORMAT',
        'file_name_format' => 'FILE_NAME_FORMAT',
        'ftp_export_batches.file_name_format' => 'FILE_NAME_FORMAT',
        'IsFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpExportBatches.IsFileProcessing' => 'IS_FILE_PROCESSING',
        'isFileProcessing' => 'IS_FILE_PROCESSING',
        'ftpExportBatches.isFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'is_file_processing' => 'IS_FILE_PROCESSING',
        'ftp_export_batches.is_file_processing' => 'IS_FILE_PROCESSING',
        'FtpOrder' => 'FTP_ORDER',
        'FtpExportBatches.FtpOrder' => 'FTP_ORDER',
        'ftpOrder' => 'FTP_ORDER',
        'ftpExportBatches.ftpOrder' => 'FTP_ORDER',
        'FtpExportBatchesTableMap::COL_FTP_ORDER' => 'FTP_ORDER',
        'COL_FTP_ORDER' => 'FTP_ORDER',
        'ftp_order' => 'FTP_ORDER',
        'ftp_export_batches.ftp_order' => 'FTP_ORDER',
        'IntervalType' => 'INTERVAL_TYPE',
        'FtpExportBatches.IntervalType' => 'INTERVAL_TYPE',
        'intervalType' => 'INTERVAL_TYPE',
        'ftpExportBatches.intervalType' => 'INTERVAL_TYPE',
        'FtpExportBatchesTableMap::COL_INTERVAL_TYPE' => 'INTERVAL_TYPE',
        'COL_INTERVAL_TYPE' => 'INTERVAL_TYPE',
        'interval_type' => 'INTERVAL_TYPE',
        'ftp_export_batches.interval_type' => 'INTERVAL_TYPE',
        'StartDate' => 'START_DATE',
        'FtpExportBatches.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'ftpExportBatches.startDate' => 'START_DATE',
        'FtpExportBatchesTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'ftp_export_batches.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'FtpExportBatches.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'ftpExportBatches.endDate' => 'END_DATE',
        'FtpExportBatchesTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'ftp_export_batches.end_date' => 'END_DATE',
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
        $this->setName('ftp_export_batches');
        $this->setPhpName('FtpExportBatches');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\FtpExportBatches');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ftp_export_batches_ftp_export_batch_id_seq');
        // columns
        $this->addPrimaryKey('ftp_export_batch_id', 'FtpExportBatchId', 'INTEGER', true, null, null);
        $this->addColumn('label', 'Label', 'VARCHAR', false, 250, null);
        $this->addColumn('attached_function', 'AttachedFunction', 'VARCHAR', false, 250, null);
        $this->addColumn('next_date', 'NextDate', 'DATE', false, null, null);
        $this->addColumn('interval_days', 'IntervalDays', 'INTEGER', false, null, null);
        $this->addColumn('ftp_path', 'FtpPath', 'LONGVARCHAR', false, null, null);
        $this->addColumn('isenabled', 'Isenabled', 'SMALLINT', false, null, 1);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('file_name_format', 'FileNameFormat', 'VARCHAR', false, 250, null);
        $this->addColumn('is_file_processing', 'IsFileProcessing', 'BOOLEAN', false, 1, false);
        $this->addColumn('ftp_order', 'FtpOrder', 'INTEGER', false, null, null);
        $this->addColumn('interval_type', 'IntervalType', 'VARCHAR', false, 200, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('FtpExportLogs', '\\entities\\FtpExportLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ftp_export_batch_id',
    1 => ':ftp_export_batch_id',
  ),
), 'CASCADE', null, 'FtpExportLogss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to ftp_export_batches     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        FtpExportLogsTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FtpExportBatchesTableMap::CLASS_DEFAULT : FtpExportBatchesTableMap::OM_CLASS;
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
     * @return array (FtpExportBatches object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = FtpExportBatchesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FtpExportBatchesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FtpExportBatchesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FtpExportBatchesTableMap::OM_CLASS;
            /** @var FtpExportBatches $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FtpExportBatchesTableMap::addInstanceToPool($obj, $key);
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
            $key = FtpExportBatchesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FtpExportBatchesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FtpExportBatches $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FtpExportBatchesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_LABEL);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_NEXT_DATE);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_INTERVAL_DAYS);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_FTP_PATH);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_ISENABLED);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_FTP_ORDER);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_INTERVAL_TYPE);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_START_DATE);
            $criteria->addSelectColumn(FtpExportBatchesTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.ftp_export_batch_id');
            $criteria->addSelectColumn($alias . '.label');
            $criteria->addSelectColumn($alias . '.attached_function');
            $criteria->addSelectColumn($alias . '.next_date');
            $criteria->addSelectColumn($alias . '.interval_days');
            $criteria->addSelectColumn($alias . '.ftp_path');
            $criteria->addSelectColumn($alias . '.isenabled');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.file_name_format');
            $criteria->addSelectColumn($alias . '.is_file_processing');
            $criteria->addSelectColumn($alias . '.ftp_order');
            $criteria->addSelectColumn($alias . '.interval_type');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
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
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_LABEL);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_NEXT_DATE);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_INTERVAL_DAYS);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_FTP_PATH);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_ISENABLED);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_FTP_ORDER);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_INTERVAL_TYPE);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(FtpExportBatchesTableMap::COL_END_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.ftp_export_batch_id');
            $criteria->removeSelectColumn($alias . '.label');
            $criteria->removeSelectColumn($alias . '.attached_function');
            $criteria->removeSelectColumn($alias . '.next_date');
            $criteria->removeSelectColumn($alias . '.interval_days');
            $criteria->removeSelectColumn($alias . '.ftp_path');
            $criteria->removeSelectColumn($alias . '.isenabled');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.file_name_format');
            $criteria->removeSelectColumn($alias . '.is_file_processing');
            $criteria->removeSelectColumn($alias . '.ftp_order');
            $criteria->removeSelectColumn($alias . '.interval_type');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(FtpExportBatchesTableMap::DATABASE_NAME)->getTable(FtpExportBatchesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a FtpExportBatches or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or FtpExportBatches object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\FtpExportBatches) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FtpExportBatchesTableMap::DATABASE_NAME);
            $criteria->add(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, (array) $values, Criteria::IN);
        }

        $query = FtpExportBatchesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FtpExportBatchesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FtpExportBatchesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ftp_export_batches table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return FtpExportBatchesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FtpExportBatches or Criteria object.
     *
     * @param mixed $criteria Criteria or FtpExportBatches object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FtpExportBatches object
        }

        if ($criteria->containsKey(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID) && $criteria->keyContainsValue(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID.')');
        }


        // Set the correct dbName
        $query = FtpExportBatchesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
