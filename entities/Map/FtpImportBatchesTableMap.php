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
use entities\FtpImportBatches;
use entities\FtpImportBatchesQuery;


/**
 * This class defines the structure of the 'ftp_import_batches' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FtpImportBatchesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.FtpImportBatchesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ftp_import_batches';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'FtpImportBatches';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\FtpImportBatches';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.FtpImportBatches';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the ftp_import_batch_id field
     */
    public const COL_FTP_IMPORT_BATCH_ID = 'ftp_import_batches.ftp_import_batch_id';

    /**
     * the column name for the label field
     */
    public const COL_LABEL = 'ftp_import_batches.label';

    /**
     * the column name for the attached_function field
     */
    public const COL_ATTACHED_FUNCTION = 'ftp_import_batches.attached_function';

    /**
     * the column name for the next_batch field
     */
    public const COL_NEXT_BATCH = 'ftp_import_batches.next_batch';

    /**
     * the column name for the ftp_path field
     */
    public const COL_FTP_PATH = 'ftp_import_batches.ftp_path';

    /**
     * the column name for the isenabled field
     */
    public const COL_ISENABLED = 'ftp_import_batches.isenabled';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ftp_import_batches.created_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ftp_import_batches.company_id';

    /**
     * the column name for the ftp_order field
     */
    public const COL_FTP_ORDER = 'ftp_import_batches.ftp_order';

    /**
     * the column name for the is_file_processing field
     */
    public const COL_IS_FILE_PROCESSING = 'ftp_import_batches.is_file_processing';

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
        self::TYPE_PHPNAME       => ['FtpImportBatchId', 'Label', 'AttachedFunction', 'NextBatch', 'FtpPath', 'Isenabled', 'CreatedAt', 'CompanyId', 'FtpOrder', 'IsFileProcessing', ],
        self::TYPE_CAMELNAME     => ['ftpImportBatchId', 'label', 'attachedFunction', 'nextBatch', 'ftpPath', 'isenabled', 'createdAt', 'companyId', 'ftpOrder', 'isFileProcessing', ],
        self::TYPE_COLNAME       => [FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, FtpImportBatchesTableMap::COL_LABEL, FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION, FtpImportBatchesTableMap::COL_NEXT_BATCH, FtpImportBatchesTableMap::COL_FTP_PATH, FtpImportBatchesTableMap::COL_ISENABLED, FtpImportBatchesTableMap::COL_CREATED_AT, FtpImportBatchesTableMap::COL_COMPANY_ID, FtpImportBatchesTableMap::COL_FTP_ORDER, FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING, ],
        self::TYPE_FIELDNAME     => ['ftp_import_batch_id', 'label', 'attached_function', 'next_batch', 'ftp_path', 'isenabled', 'created_at', 'company_id', 'ftp_order', 'is_file_processing', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['FtpImportBatchId' => 0, 'Label' => 1, 'AttachedFunction' => 2, 'NextBatch' => 3, 'FtpPath' => 4, 'Isenabled' => 5, 'CreatedAt' => 6, 'CompanyId' => 7, 'FtpOrder' => 8, 'IsFileProcessing' => 9, ],
        self::TYPE_CAMELNAME     => ['ftpImportBatchId' => 0, 'label' => 1, 'attachedFunction' => 2, 'nextBatch' => 3, 'ftpPath' => 4, 'isenabled' => 5, 'createdAt' => 6, 'companyId' => 7, 'ftpOrder' => 8, 'isFileProcessing' => 9, ],
        self::TYPE_COLNAME       => [FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID => 0, FtpImportBatchesTableMap::COL_LABEL => 1, FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION => 2, FtpImportBatchesTableMap::COL_NEXT_BATCH => 3, FtpImportBatchesTableMap::COL_FTP_PATH => 4, FtpImportBatchesTableMap::COL_ISENABLED => 5, FtpImportBatchesTableMap::COL_CREATED_AT => 6, FtpImportBatchesTableMap::COL_COMPANY_ID => 7, FtpImportBatchesTableMap::COL_FTP_ORDER => 8, FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING => 9, ],
        self::TYPE_FIELDNAME     => ['ftp_import_batch_id' => 0, 'label' => 1, 'attached_function' => 2, 'next_batch' => 3, 'ftp_path' => 4, 'isenabled' => 5, 'created_at' => 6, 'company_id' => 7, 'ftp_order' => 8, 'is_file_processing' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FtpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'FtpImportBatches.FtpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'ftpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'ftpImportBatches.ftpImportBatchId' => 'FTP_IMPORT_BATCH_ID',
        'FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID' => 'FTP_IMPORT_BATCH_ID',
        'COL_FTP_IMPORT_BATCH_ID' => 'FTP_IMPORT_BATCH_ID',
        'ftp_import_batch_id' => 'FTP_IMPORT_BATCH_ID',
        'ftp_import_batches.ftp_import_batch_id' => 'FTP_IMPORT_BATCH_ID',
        'Label' => 'LABEL',
        'FtpImportBatches.Label' => 'LABEL',
        'label' => 'LABEL',
        'ftpImportBatches.label' => 'LABEL',
        'FtpImportBatchesTableMap::COL_LABEL' => 'LABEL',
        'COL_LABEL' => 'LABEL',
        'ftp_import_batches.label' => 'LABEL',
        'AttachedFunction' => 'ATTACHED_FUNCTION',
        'FtpImportBatches.AttachedFunction' => 'ATTACHED_FUNCTION',
        'attachedFunction' => 'ATTACHED_FUNCTION',
        'ftpImportBatches.attachedFunction' => 'ATTACHED_FUNCTION',
        'FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION' => 'ATTACHED_FUNCTION',
        'COL_ATTACHED_FUNCTION' => 'ATTACHED_FUNCTION',
        'attached_function' => 'ATTACHED_FUNCTION',
        'ftp_import_batches.attached_function' => 'ATTACHED_FUNCTION',
        'NextBatch' => 'NEXT_BATCH',
        'FtpImportBatches.NextBatch' => 'NEXT_BATCH',
        'nextBatch' => 'NEXT_BATCH',
        'ftpImportBatches.nextBatch' => 'NEXT_BATCH',
        'FtpImportBatchesTableMap::COL_NEXT_BATCH' => 'NEXT_BATCH',
        'COL_NEXT_BATCH' => 'NEXT_BATCH',
        'next_batch' => 'NEXT_BATCH',
        'ftp_import_batches.next_batch' => 'NEXT_BATCH',
        'FtpPath' => 'FTP_PATH',
        'FtpImportBatches.FtpPath' => 'FTP_PATH',
        'ftpPath' => 'FTP_PATH',
        'ftpImportBatches.ftpPath' => 'FTP_PATH',
        'FtpImportBatchesTableMap::COL_FTP_PATH' => 'FTP_PATH',
        'COL_FTP_PATH' => 'FTP_PATH',
        'ftp_path' => 'FTP_PATH',
        'ftp_import_batches.ftp_path' => 'FTP_PATH',
        'Isenabled' => 'ISENABLED',
        'FtpImportBatches.Isenabled' => 'ISENABLED',
        'isenabled' => 'ISENABLED',
        'ftpImportBatches.isenabled' => 'ISENABLED',
        'FtpImportBatchesTableMap::COL_ISENABLED' => 'ISENABLED',
        'COL_ISENABLED' => 'ISENABLED',
        'ftp_import_batches.isenabled' => 'ISENABLED',
        'CreatedAt' => 'CREATED_AT',
        'FtpImportBatches.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ftpImportBatches.createdAt' => 'CREATED_AT',
        'FtpImportBatchesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ftp_import_batches.created_at' => 'CREATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'FtpImportBatches.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ftpImportBatches.companyId' => 'COMPANY_ID',
        'FtpImportBatchesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ftp_import_batches.company_id' => 'COMPANY_ID',
        'FtpOrder' => 'FTP_ORDER',
        'FtpImportBatches.FtpOrder' => 'FTP_ORDER',
        'ftpOrder' => 'FTP_ORDER',
        'ftpImportBatches.ftpOrder' => 'FTP_ORDER',
        'FtpImportBatchesTableMap::COL_FTP_ORDER' => 'FTP_ORDER',
        'COL_FTP_ORDER' => 'FTP_ORDER',
        'ftp_order' => 'FTP_ORDER',
        'ftp_import_batches.ftp_order' => 'FTP_ORDER',
        'IsFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpImportBatches.IsFileProcessing' => 'IS_FILE_PROCESSING',
        'isFileProcessing' => 'IS_FILE_PROCESSING',
        'ftpImportBatches.isFileProcessing' => 'IS_FILE_PROCESSING',
        'FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'COL_IS_FILE_PROCESSING' => 'IS_FILE_PROCESSING',
        'is_file_processing' => 'IS_FILE_PROCESSING',
        'ftp_import_batches.is_file_processing' => 'IS_FILE_PROCESSING',
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
        $this->setName('ftp_import_batches');
        $this->setPhpName('FtpImportBatches');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\FtpImportBatches');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ftp_import_batches_ftp_import_batch_id_seq');
        // columns
        $this->addPrimaryKey('ftp_import_batch_id', 'FtpImportBatchId', 'INTEGER', true, null, null);
        $this->addColumn('label', 'Label', 'VARCHAR', false, 250, null);
        $this->addColumn('attached_function', 'AttachedFunction', 'VARCHAR', false, 250, null);
        $this->addColumn('next_batch', 'NextBatch', 'INTEGER', false, null, 1);
        $this->addColumn('ftp_path', 'FtpPath', 'LONGVARCHAR', false, null, null);
        $this->addColumn('isenabled', 'Isenabled', 'SMALLINT', false, null, 1);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('ftp_order', 'FtpOrder', 'INTEGER', false, null, null);
        $this->addColumn('is_file_processing', 'IsFileProcessing', 'BOOLEAN', false, 1, false);
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
        $this->addRelation('FtpImportLogs', '\\entities\\FtpImportLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ftp_import_batch_id',
    1 => ':ftp_import_batch_id',
  ),
), 'CASCADE', null, 'FtpImportLogss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to ftp_import_batches     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        FtpImportLogsTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FtpImportBatchesTableMap::CLASS_DEFAULT : FtpImportBatchesTableMap::OM_CLASS;
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
     * @return array (FtpImportBatches object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = FtpImportBatchesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FtpImportBatchesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FtpImportBatchesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FtpImportBatchesTableMap::OM_CLASS;
            /** @var FtpImportBatches $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FtpImportBatchesTableMap::addInstanceToPool($obj, $key);
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
            $key = FtpImportBatchesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FtpImportBatchesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FtpImportBatches $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FtpImportBatchesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_LABEL);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_NEXT_BATCH);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_FTP_PATH);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_ISENABLED);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_FTP_ORDER);
            $criteria->addSelectColumn(FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING);
        } else {
            $criteria->addSelectColumn($alias . '.ftp_import_batch_id');
            $criteria->addSelectColumn($alias . '.label');
            $criteria->addSelectColumn($alias . '.attached_function');
            $criteria->addSelectColumn($alias . '.next_batch');
            $criteria->addSelectColumn($alias . '.ftp_path');
            $criteria->addSelectColumn($alias . '.isenabled');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.ftp_order');
            $criteria->addSelectColumn($alias . '.is_file_processing');
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
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_LABEL);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_ATTACHED_FUNCTION);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_NEXT_BATCH);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_FTP_PATH);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_ISENABLED);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_FTP_ORDER);
            $criteria->removeSelectColumn(FtpImportBatchesTableMap::COL_IS_FILE_PROCESSING);
        } else {
            $criteria->removeSelectColumn($alias . '.ftp_import_batch_id');
            $criteria->removeSelectColumn($alias . '.label');
            $criteria->removeSelectColumn($alias . '.attached_function');
            $criteria->removeSelectColumn($alias . '.next_batch');
            $criteria->removeSelectColumn($alias . '.ftp_path');
            $criteria->removeSelectColumn($alias . '.isenabled');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.ftp_order');
            $criteria->removeSelectColumn($alias . '.is_file_processing');
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
        return Propel::getServiceContainer()->getDatabaseMap(FtpImportBatchesTableMap::DATABASE_NAME)->getTable(FtpImportBatchesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a FtpImportBatches or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or FtpImportBatches object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportBatchesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\FtpImportBatches) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FtpImportBatchesTableMap::DATABASE_NAME);
            $criteria->add(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID, (array) $values, Criteria::IN);
        }

        $query = FtpImportBatchesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FtpImportBatchesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FtpImportBatchesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ftp_import_batches table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return FtpImportBatchesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FtpImportBatches or Criteria object.
     *
     * @param mixed $criteria Criteria or FtpImportBatches object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportBatchesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FtpImportBatches object
        }

        if ($criteria->containsKey(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID) && $criteria->keyContainsValue(FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FtpImportBatchesTableMap::COL_FTP_IMPORT_BATCH_ID.')');
        }


        // Set the correct dbName
        $query = FtpImportBatchesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
